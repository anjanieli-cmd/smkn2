<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'url', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /** URL lengkap logo (path relatif dari folder public, atau URL http penuh). */
    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->logo
                ? (str_starts_with($this->logo, 'http') ? $this->logo : asset($this->logo))
                : null
        );
    }
}
