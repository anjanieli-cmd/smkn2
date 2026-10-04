<?php

namespace App\Models;

use App\Support\KaryaMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KaryaWork extends Model
{
    protected $table = 'karya_works';

    protected $fillable = [
        'title', 'description', 'photo', 'category_key',
        'tag_label', 'tag_icon',
        'student_label', 'major_label', 'major_icon', 'major_short', 'year_label',
        'show_in_slider', 'show_in_products', 'order', 'is_active',
    ];

    protected $casts = [
        'show_in_slider'   => 'boolean',
        'show_in_products' => 'boolean',
        'is_active'        => 'boolean',
        'order'            => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function getCoverUrlAttribute(): string
    {
        return KaryaMedia::url($this->photo);
    }

    public function hasUploadedCover(): bool
    {
        return KaryaMedia::isUploaded($this->photo);
    }
}
