<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Throwable;

class ConvertStaticImgAssetsToWebp extends Command
{
    protected $signature = 'photos:img-webp
        {folders?* : Folder names inside public/img}
        {--max=1600 : Maximum width or height}
        {--quality=82 : WebP quality}
        {--min-kb=0 : Only convert files larger than this size}
        {--dry-run : Show candidates without changing files or views}
        {--delete-original : Delete original files after successful conversion}
        {--no-update-views : Do not update Blade references}
        {--overwrite : Recreate WebP files even when the target already exists}';

    protected $description = 'Convert static public/img folders to WebP and update Blade references.';

    private array $defaultFolders = [
        'gala',
        'gts',
        'jaff',
        'p.home',
        'roadshow',
        'sinemakuday',
        'special',
        'tentang',
    ];

    public function handle(): int
    {
        $folders = $this->argument('folders') ?: $this->defaultFolders;
        $maxDimension = (int) $this->option('max');
        $quality = (int) $this->option('quality');
        $minBytes = (int) $this->option('min-kb') * 1024;
        $dryRun = (bool) $this->option('dry-run');
        $deleteOriginal = (bool) $this->option('delete-original');
        $updateViews = !$this->option('no-update-views');
        $overwrite = (bool) $this->option('overwrite');
        $backupDir = public_path('img_webp_backup_' . date('Ymd_His'));
        $viewBackupDir = resource_path('views_webp_backup_' . date('Ymd_His'));
        $replacements = [];
        $converted = 0;
        $skipped = 0;
        $savedBytes = 0;

        if (!$dryRun && !$deleteOriginal && !is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        foreach ($folders as $folder) {
            $folder = trim((string) $folder, '/');
            $targetDir = public_path('img/' . $folder);

            if (!is_dir($targetDir)) {
                $this->warn("[missing] public/img/{$folder}");
                continue;
            }

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($targetDir, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($files as $file) {
                if (!$file->isFile()) {
                    continue;
                }

                $sourcePath = $file->getPathname();
                $extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));

                if (!in_array($extension, ['jpg', 'jpeg', 'png'], true) || $file->getSize() < $minBytes) {
                    $skipped++;
                    continue;
                }

                $relativePath = ltrim(str_replace(public_path() . '/', '', $sourcePath), '/');
                $targetPath = $this->webpPath($sourcePath);
                $targetRelativePath = ltrim(str_replace(public_path() . '/', '', $targetPath), '/');
                $before = $file->getSize();

                $replacements[$relativePath] = $targetRelativePath;

                if ($dryRun) {
                    $this->line("[candidate] {$relativePath} -> {$targetRelativePath} ({$this->formatBytes($before)})");
                    $converted++;
                    continue;
                }

                try {
                    if (is_file($targetPath) && !$overwrite) {
                        $this->line("[exists] {$targetRelativePath}");
                    } else {
                        if (!$deleteOriginal) {
                            $this->backupFile($sourcePath, $backupDir);
                        }

                        $image = Image::make($sourcePath)->orientate();

                        $image->resize($maxDimension, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

                        if ($image->height() > $maxDimension) {
                            $image->resize(null, $maxDimension, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        }

                        $image->encode('webp', $quality)->save($targetPath);
                    }

                    clearstatcache(true, $targetPath);
                    $after = is_file($targetPath) ? filesize($targetPath) : $before;
                    $savedBytes += max(0, $before - $after);
                    $converted++;

                    if ($deleteOriginal && is_file($targetPath) && is_file($sourcePath)) {
                        unlink($sourcePath);
                    }

                    $this->line("[webp] {$relativePath} {$this->formatBytes($before)} -> {$this->formatBytes($after)}");
                } catch (Throwable $e) {
                    $skipped++;
                    $this->warn("[skipped] {$relativePath} ({$e->getMessage()})");
                }
            }
        }

        $updatedViews = 0;
        if ($updateViews && count($replacements) > 0) {
            $updatedViews = $this->updateViewReferences($replacements, $dryRun, $viewBackupDir);
        }

        $this->info("Done. Converted: {$converted}, skipped: {$skipped}, views updated: {$updatedViews}, saved: " . $this->formatBytes($savedBytes));

        if (!$dryRun && !$deleteOriginal) {
            $this->info('Image backup: ' . str_replace(public_path() . '/', 'public/', $backupDir));
        }

        if (!$dryRun && $updateViews && $updatedViews > 0) {
            $this->info('View backup: ' . str_replace(resource_path() . '/', 'resources/', $viewBackupDir));
        }

        return 0;
    }

    private function webpPath(string $sourcePath): string
    {
        return dirname($sourcePath) . '/' . pathinfo($sourcePath, PATHINFO_FILENAME) . '.webp';
    }

    private function backupFile(string $sourcePath, string $backupDir): void
    {
        $relativePath = ltrim(str_replace(public_path() . '/', '', $sourcePath), '/');
        $backupPath = $backupDir . '/' . $relativePath;
        $backupParent = dirname($backupPath);

        if (!is_dir($backupParent)) {
            mkdir($backupParent, 0755, true);
        }

        copy($sourcePath, $backupPath);
    }

    private function updateViewReferences(array $replacements, bool $dryRun, string $viewBackupDir): int
    {
        $updated = 0;
        $viewsDir = resource_path('views');
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($viewsDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if (!$file->isFile() || !Str::endsWith($file->getFilename(), '.blade.php')) {
                continue;
            }

            $path = $file->getPathname();
            $contents = file_get_contents($path);
            $newContents = $contents;

            foreach ($replacements as $from => $to) {
                $newContents = str_replace($from, $to, $newContents);
            }

            if ($newContents === $contents) {
                continue;
            }

            $relativePath = ltrim(str_replace($viewsDir, '', $path), '/');

            if ($dryRun) {
                $this->line("[view] resources/views/{$relativePath}");
                $updated++;
                continue;
            }

            $backupPath = $viewBackupDir . '/' . $relativePath;
            $backupParent = dirname($backupPath);

            if (!is_dir($backupParent)) {
                mkdir($backupParent, 0755, true);
            }

            copy($path, $backupPath);
            file_put_contents($path, $newContents);
            $updated++;
        }

        return $updated;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }

        return round($bytes / 1024, 1) . ' KB';
    }
}
