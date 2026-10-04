<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/** Slide "Lulusan PTN" di beranda: satu perguruan tinggi beserta daftar nama yang lolos. */
class HomePtn extends Model
{
    protected $fillable = ['name', 'logo', 'students', 'is_active', 'order'];

    protected $casts = [
        'students'  => 'array',
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

    /**
     * Teks untuk textarea admin: satu baris = satu siswa.
     * Format: Nama | Program Studi | Kelas | Jalur
     */
    protected function studentsText(): Attribute
    {
        return Attribute::make(get: function () {
            return collect($this->students ?? [])->map(function ($s) {
                return implode(' | ', [
                    $s['name'] ?? '', $s['program'] ?? '', $s['class_label'] ?? '', $s['path'] ?? '',
                ]);
            })->implode("\n");
        });
    }
}
