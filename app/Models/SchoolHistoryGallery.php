<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolHistoryGallery extends Model
{
    protected $fillable = [
        'school_history_id', 'image', 'small_label', 'big_label', 'is_featured', 'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
