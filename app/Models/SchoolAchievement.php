<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SchoolAchievement extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'level',
        'level_label',
        'year',
        'rank',
        'tag',
        'event_date',
        'winner_name',
        'description',
        'image_url',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'event_date'  => 'date',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /** Urutan tampil: tahun terbaru, lalu tanggal terbaru, lalu yang paling baru dibuat. */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('year')
            ->orderByDesc('event_date')
            ->orderByDesc('created_at');
    }

    /** Hanya yang berstatus tampil, dipakai halaman publik. */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)->ordered();
    }
}