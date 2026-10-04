<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Helper foto Karya Siswa. Path yang diawali "images/" = file bawaan di folder public,
 * selain itu = hasil upload admin di storage/app/public.
 */
class KaryaMedia
{
    public const FALLBACK = 'images/logo_smkn2.png';

    public static function url(?string $path): string
    {
        if (!$path) {
            return asset(self::FALLBACK);
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }

    public static function isUploaded(?string $path): bool
    {
        return $path && !str_starts_with($path, 'images/');
    }

    public static function delete(?string $path): void
    {
        if (self::isUploaded($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
