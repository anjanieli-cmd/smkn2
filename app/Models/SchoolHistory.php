<?php

namespace App\Models;

use App\Models\Concerns\HasResolvableImages;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolHistory extends Model
{
    use HasResolvableImages;

    protected $fillable = [
        'hero_kicker', 'hero_image',
        'intro_eyebrow', 'intro_title', 'intro_desc',
        'stat1_value', 'stat1_label',
        'stat2_value', 'stat2_label',
        'stat3_value', 'stat3_label',
        'stat4_value', 'stat4_label',
        'story_eyebrow', 'story_title', 'story_desc', 'story_image', 'story_chips',
        'vt_title', 'vt_desc', 'vt_link', 'vt_image',
    ];

    protected $casts = [
        'story_chips' => 'array',
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(SchoolHistoryChapter::class)->orderBy('order');
    }

    public function principals(): HasMany
    {
        return $this->hasMany(SchoolHistoryPrincipal::class)->orderBy('order');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(SchoolHistoryGallery::class)->orderBy('order');
    }

    protected function heroImageUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->resolveImageUrl($this->hero_image));
    }

    protected function storyImageUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->resolveImageUrl($this->story_image));
    }

    protected function vtImageUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->resolveImageUrl($this->vt_image));
    }

    /** Selalu ambil satu baris singleton, buat kalau belum ada. */
    public static function singleton(): self
    {
        return static::query()->firstOrCreate([]);
    }
}