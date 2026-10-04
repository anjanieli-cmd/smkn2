<?php

namespace App\Models;

use App\Support\KegiatanMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KegiatanAlbum extends Model
{
    /** Pilihan ukuran kartu di galeri masonry. */
    public const SIZES = [
        'auto'     => 'Otomatis (mengikuti pola galeri)',
        'standard' => 'Standar',
        'md'       => 'Sedang (lebih tinggi)',
        'lg'       => 'Besar (tinggi)',
        'tall'     => 'Sangat tinggi',
        'wide'     => 'Lebar (2 kolom)',
    ];

    protected $table = 'kegiatan_albums';

    protected $fillable = [
        'title', 'category_key', 'date_label', 'description', 'photo',
        'size', 'show_in_gallery', 'order', 'is_active',
    ];

    protected $casts = [
        'show_in_gallery' => 'boolean',
        'is_active'       => 'boolean',
        'order'           => 'integer',
    ];

    public function photos()
    {
        return $this->hasMany(KegiatanPhoto::class, 'album_id')->orderBy('order')->orderBy('id');
    }

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
        return KegiatanMedia::url($this->photo);
    }

    public function hasUploadedCover(): bool
    {
        return KegiatanMedia::isUploaded($this->photo);
    }

    /** Semua foto untuk popup album: sampul dulu, lalu foto tambahan. */
    public function lightboxUrls(): array
    {
        $urls = [$this->cover_url];

        foreach ($this->photos as $p) {
            $urls[] = $p->url;
        }

        return $urls;
    }
}
