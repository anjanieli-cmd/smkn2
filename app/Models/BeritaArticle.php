<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BeritaArticle extends Model
{
    public const FALLBACK_PHOTO = 'images/logo_smkn2.png';

    protected $table = 'berita_articles';

    protected $fillable = [
        'title', 'category_key', 'date_label', 'excerpt', 'content',
        'photo', 'show_in_initial_ten', 'order', 'is_active',
    ];

    protected $casts = [
        'show_in_initial_ten' => 'boolean',
        'order'                => 'integer',
        'is_active'            => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo) {
            return asset(self::FALLBACK_PHOTO);
        }

        if (str_starts_with($this->photo, 'images/')) {
            return asset($this->photo);
        }

        return Storage::disk('public')->url($this->photo);
    }

    public function hasUploadedPhoto(): bool
    {
        return $this->photo && !str_starts_with($this->photo, 'images/');
    }

    /** Paragraf isi modal, satu per baris di database. */
    public function getContentParagraphsAttribute(): array
    {
        return array_values(array_filter(array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', (string) $this->content) ?: []
        ), fn ($p) => $p !== ''));
    }
}
