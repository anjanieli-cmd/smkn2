<?php

namespace App\Models;

use App\Models\Concerns\HasResolvableImages;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SchoolHistoryPrincipal extends Model
{
    use HasResolvableImages;

    protected $fillable = [
        'school_history_id', 'name', 'period_label', 'photo', 'caption', 'is_current', 'order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    protected function photoUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->resolveImageUrl($this->photo));
    }
}