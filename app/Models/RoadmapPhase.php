<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapPhase extends Model
{
    protected $fillable = ['year', 'icon', 'title', 'text', 'items', 'tag', 'is_goal', 'order'];

    protected $casts = [
        'items'   => 'array',
        'is_goal' => 'boolean',
    ];
}
