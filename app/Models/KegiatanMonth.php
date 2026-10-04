<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KegiatanMonth extends Model
{
    protected $table = 'kegiatan_months';

    protected $fillable = ['label', 'event', 'note', 'order', 'is_active'];

    protected $casts = [
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
