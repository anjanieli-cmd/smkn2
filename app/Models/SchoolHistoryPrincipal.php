<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolHistoryPrincipal extends Model
{
    protected $fillable = [
        'school_history_id', 'name', 'period_label', 'photo', 'caption', 'is_current', 'order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];
}
