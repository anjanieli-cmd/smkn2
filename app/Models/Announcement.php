<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['icon', 'text', 'url', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Pengumuman aktif, urut sesuai pengaturan admin. */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
