<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;

class ConvertPhotoAssetsToWebp extends Command
{
    protected $signature = 'photos:webp
        {--max=1600 : Maximum width or height}
        {--quality=82 : WebP quality}
        {--dry-run : Show what would be converted without changing files or database}
        {--delete-original : Delete original files after successful conversion}';

    protected $description = 'Convert referenced JPG/PNG photo assets to WebP and update database references.';

    private array $references = [
        ['table' => 'films', 'columns' => ['photo', 'poster', 'cover']],
        ['table' => 'film_galleries', 'columns' => ['photo']],
        ['table' => 'episodes', 'columns' => ['photo']],
        ['table' => 'events', 'columns' => ['photo']],
        ['table' => 'event_photos', 'columns' => ['photo']],
        ['table' => 'articles', 'columns' => ['photo']],
        ['table' => 'shops', 'columns' => ['photo']],
        ['table' => 'slides', 'columns' => ['photo']],
        ['table' => 'hero_slides', 'columns' => ['image_path']],
        ['table' => 'site_settings', 'columns' => ['value']],
    ];

    public function handle(): int
    {
        $maxDimension = (int) $this->option('max');
        $quality = (int) $this->option('quality');
        $dryRun = (bool) $this->option('dry-run');
        $deleteOriginal = (bool) $this->option('delete-original');
        $backupDir = public_path('photo_webp_backup_' . date('Ymd_His'));
        $convertedFiles = [];
        $converted = 0;
        $skipped = 0;

        if (!$dryRun && !$deleteOriginal && !is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        foreach ($this->references as $reference) {
            $table = $reference['table'];

            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'id')) {
                continue;
            }

            foreach ($reference['columns'] as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                DB::table($table)
                    ->select('id', $column)
                    ->whereNotNull($column)
                    ->orderBy('id')
                    ->chunkById(100, function ($rows) use ($table, $column, $maxDimension, $quality, $dryRun, $deleteOriginal, $backupDir, &$convertedFiles, &$converted, &$skipped) {
                        foreach ($rows as $row) {
                            $value = trim((string) $row->{$column});
                            $normalized = $this->normalizePhotoValue($value);

                            if (!$normalized) {
                                $skipped++;
                                continue;
                            }

                            [$relativePath, $preservesPhotoPrefix] = $normalized;
                            $sourcePath = public_path($relativePath);

                            if (!is_file($sourcePath)) {
                                $skipped++;
                                continue;
                            }

                            $extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
                            if (!in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
                                $skipped++;
                                continue;
                            }

                            if (!isset($convertedFiles[$sourcePath])) {
                                $newFilename = $this->convertFile($sourcePath, $maxDimension, $quality, $dryRun, $deleteOriginal, $backupDir);

                                if (!$newFilename) {
                                    $skipped++;
                                    continue;
                                }

                                $convertedFiles[$sourcePath] = $newFilename;
                            }

                            $newValue = $preservesPhotoPrefix
                                ? 'photo/' . $convertedFiles[$sourcePath]
                                : $convertedFiles[$sourcePath];

                            if ($dryRun) {
                                $this->line("[candidate] {$table}.{$column}#{$row->id}: {$value} -> {$newValue}");
                            } else {
                                DB::table($table)->where('id', $row->id)->update([$column => $newValue]);
                            }

                            $converted++;
                        }
                    }, 'id');
            }
        }

        $this->info("Done. References converted: {$converted}, skipped: {$skipped}");

        if (!$dryRun && !$deleteOriginal) {
            $this->info('Original backup: ' . str_replace(public_path() . '/', 'public/', $backupDir));
        }

        return 0;
    }

    private function normalizePhotoValue(string $value): ?array
    {
        if ($value === '' || preg_match('/^https?:\/\//i', $value) || str_starts_with($value, '/')) {
            return null;
        }

        $path = parse_url($value, PHP_URL_PATH) ?: $value;
        $path = ltrim($path, '/');

        if (str_starts_with($path, 'photo/')) {
            return [$path, true];
        }

        if (str_contains($path, '/')) {
            return null;
        }

        return ['photo/' . $path, false];
    }

    private function convertFile(string $sourcePath, int $maxDimension, int $quality, bool $dryRun, bool $deleteOriginal, string $backupDir): ?string
    {
        $sourceFilename = basename($sourcePath);
        $baseName = Str::slug(pathinfo($sourceFilename, PATHINFO_FILENAME)) ?: 'image';
        $newFilename = $baseName . '_' . uniqid() . '.webp';
        $targetPath = dirname($sourcePath) . '/' . $newFilename;

        if ($dryRun) {
            return $newFilename;
        }

        try {
            if (!$deleteOriginal) {
                copy($sourcePath, $backupDir . '/' . $sourceFilename);
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

            if ($deleteOriginal) {
                unlink($sourcePath);
            }

            return $newFilename;
        } catch (Throwable $e) {
            $this->warn('[skipped] ' . str_replace(public_path() . '/', '', $sourcePath) . ' (' . $e->getMessage() . ')');
            return null;
        }
    }
}
