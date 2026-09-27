<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

trait HasResolvableImages
{
    /**
     * Resolve path gambar jadi URL yang benar, baik untuk:
     * - aset lama di public/images/... (contoh: "images/kepsek1.jpeg")
     * - file baru hasil upload admin, disimpan di storage/app/public (contoh: "history/xxx.jpg")
     * - URL absolut (http/https) yang mungkin kepasang manual
     */
    protected function resolveImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}