<?php

namespace App\Models;

use App\Models\Concerns\HasResolvableImages;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SchoolHistoryGallery extends Model
{
    use HasResolvableImages;

    protected $fillable = [
        'school_history_id', 'image', 'small_label', 'big_label', 'is_featured', 'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->resolveImageUrl($this->image));
    }
}