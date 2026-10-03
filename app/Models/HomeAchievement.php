<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/** Kartu "feed" pada bagian "Prestasi Sekolah" di beranda (terpisah dari tabel school_achievements). */
class HomeAchievement extends Model
{
    protected $fillable = [
        'image', 'tag', 'title', 'subtitle', 'description', 'year', 'meta_label', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image
                ? (str_starts_with($this->image, 'http') ? $this->image : asset($this->image))
                : null
        );
    }
}
