<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Throwable;

class OptimizePhotoAssets extends Command
{
    protected $signature = 'photos:optimize
        {--path=photo : Public directory to optimize}
        {--max=1920 : Maximum width or height}
        {--quality=86 : Output quality for JPEG/WebP}
        {--min-kb=700 : Only optimize files larger than this size}
        {--dry-run : Show candidates without changing files}
        {--no-backup : Overwrite without creating public/photo_backup_*}';

    protected $description = 'Resize and compress existing public photo assets while preserving filenames.';

    public function handle(): int
    {
        $relativePath = trim((string) $this->option('path'), '/');
        $targetDir = public_path($relativePath);

        if (!is_dir($targetDir)) {
            $this->error("Directory not found: {$targetDir}");
            return 1;
        }

        $maxDimension = (int) $this->option('max');
        $quality = (int) $this->option('quality');
        $minBytes = (int) $this->option('min-kb') * 1024;
        $dryRun = (bool) $this->option('dry-run');
        $withBackup = !$this->option('no-backup') && !$dryRun;
        $backupDir = public_path($relativePath . '_backup_' . date('Ymd_His'));

        if ($withBackup && !is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $processed = 0;
        $skipped = 0;
        $savedBytes = 0;

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($targetDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $path = $file->getPathname();
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            if (!in_array($extension, $allowed, true) || $file->getSize() < $minBytes) {
                $skipped++;
                continue;
            }

            $before = $file->getSize();

            if ($dryRun) {
                $this->line('[candidate] ' . str_replace(public_path() . '/', '', $path) . ' (' . $this->formatBytes($before) . ')');
                $processed++;
                continue;
            }

            try {
                if ($withBackup) {
                    $backupPath = $backupDir . '/' . ltrim(str_replace($targetDir, '', $path), '/');
                    $backupParent = dirname($backupPath);
                    if (!is_dir($backupParent)) {
                        mkdir($backupParent, 0755, true);
                    }
                    copy($path, $backupPath);
                }

                $image = Image::make($path)->orientate();

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

                $image->save($path, $quality);

                clearstatcache(true, $path);
                $after = filesize($path);
                $savedBytes += max(0, $before - $after);
                $processed++;

                $this->line('[optimized] ' . str_replace(public_path() . '/', '', $path) . ' ' . $this->formatBytes($before) . ' -> ' . $this->formatBytes($after));
            } catch (Throwable $e) {
                $skipped++;
                $this->warn('[skipped] ' . str_replace(public_path() . '/', '', $path) . ' (' . $e->getMessage() . ')');
            }
        }

        $this->info("Done. Processed: {$processed}, skipped: {$skipped}, saved: " . $this->formatBytes($savedBytes));

        if ($withBackup) {
            $this->info('Backup: ' . str_replace(public_path() . '/', 'public/', $backupDir));
        }

        return 0;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }

        return round($bytes / 1024, 1) . ' KB';
    }
}
