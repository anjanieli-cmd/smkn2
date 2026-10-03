<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/** Logo pada bagian "Kerja Sama Industri" di beranda (terpisah dari tabel DUDI milik halaman BKK). */
class HomeIndustryLogo extends Model
{
    protected $fillable = ['name', 'logo', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->logo
                ? (str_starts_with($this->logo, 'http') ? $this->logo : asset($this->logo))
                : null
        );
    }
}
