<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BkkIndustry extends Model
{
    protected $table = 'bkk_industries';

    protected $fillable = ['company_name', 'field_of_work', 'partnership_scope', 'order', 'is_active'];

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

    /** Huruf awal untuk ikon kartu, tanpa awalan PT / CV / UD. */
    public function getInitialAttribute(): string
    {
        $name = preg_replace('/^(PT|CV|UD)\.?\s+/i', '', (string) $this->company_name);

        return Str::upper(Str::substr($name, 0, 1)) ?: '?';
    }
}
