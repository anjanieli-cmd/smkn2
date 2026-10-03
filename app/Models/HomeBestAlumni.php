<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/** Kartu pada bagian "Lulusan Terbaik" di beranda (satu lulusan per jurusan). */
class HomeBestAlumni extends Model
{
    protected $table = 'home_best_alumni';

    protected $fillable = ['major_abbr', 'major_name', 'name', 'year', 'code', 'photo', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->photo
                ? (str_starts_with($this->photo, 'http') ? $this->photo : asset($this->photo))
                : null
        );
    }
}
