<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;

class ImageOptimizer
{
    public static function save(
        UploadedFile $file,
        string $directory = 'photo',
        ?string $basename = null,
        int $maxWidth = 1600,
        int $maxHeight = 1600,
        int $quality = 82
    ): string {
        $directory = trim($directory, '/');
        $targetDir = public_path($directory);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $originalExtension = strtolower($file->getClientOriginalExtension());
        $safeBase = Str::slug($basename ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $safeBase = $safeBase ?: 'image';

        if (in_array($originalExtension, ['svg', 'gif'], true)) {
            return self::moveOriginal($file, $targetDir, $safeBase, $originalExtension);
        }

        try {
            $filename = $safeBase . '_' . uniqid() . '.webp';
            $image = Image::make($file->getRealPath())->orientate();

            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if ($image->height() > $maxHeight) {
                $image->resize(null, $maxHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $image->encode('webp', $quality)->save($targetDir . '/' . $filename);

            return $filename;
        } catch (Throwable $e) {
            return self::moveOriginal($file, $targetDir, $safeBase, $originalExtension ?: 'jpg');
        }
    }

    private static function moveOriginal(UploadedFile $file, string $targetDir, string $safeBase, string $extension): string
    {
        $filename = $safeBase . '_' . uniqid() . '.' . $extension;
        $file->move($targetDir, $filename);

        return $filename;
    }
}
