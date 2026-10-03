<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/** Kartu pada carousel "Jurusan Unggulan" di beranda. */
class HomeMajor extends Model
{
    protected $fillable = ['abbr', 'full_name', 'image', 'url', 'color', 'is_active', 'order'];

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

    /** Variabel CSS warna kartu (--jur-color, --jur-glow, --jur-shadow) dari kode hex. */
    protected function cssVars(): Attribute
    {
        return Attribute::make(get: function () {
            $hex = ltrim((string) $this->color, '#');
            if (!preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
                return '';
            }
            [$r, $g, $b] = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];

            return "--jur-color:#{$hex};--jur-glow:rgba({$r},{$g},{$b},.50);--jur-shadow:rgba({$r},{$g},{$b},.28)";
        });
    }
}
