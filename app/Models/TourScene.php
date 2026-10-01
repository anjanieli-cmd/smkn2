<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourScene extends Model
{
    protected $fillable = [
        'slug', 'title', 'category', 'icon', 'description',
        'panorama', 'haov', 'vaov', 'v_offset', 'order', 'is_home',
    ];

    protected $casts = [
        'is_home'  => 'boolean',
        'haov'     => 'integer',
        'vaov'     => 'float',
        'v_offset' => 'integer',
    ];

    /** Hotspot yang muncul DI scene ini (tombol menuju scene lain). */
    public function hotspots(): HasMany
    {
        return $this->hasMany(TourHotspot::class, 'tour_scene_id')->orderBy('order');
    }

    /**
     * URL foto panorama.
     * - Foto lama yang ada di public/ (mis. "tour/gerbang-utama.jpg") -> asset()
     * - Foto hasil upload admin (disimpan di storage public disk) -> Storage url
     */
    protected function panoramaUrl(): Attribute
    {
        return Attribute::make(get: function () {
            $path = $this->panorama;
            if (!$path) {
                return null;
            }
            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }
            if (file_exists(public_path($path))) {
                return asset($path);
            }
            return Storage::disk('public')->url($path);
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'lokasi';
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }
}
