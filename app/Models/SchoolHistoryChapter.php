<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolHistoryChapter extends Model
{
    protected $fillable = [
        'school_history_id', 'kicker', 'year_label', 'icon', 'tag',
        'short_title', 'short_desc', 'long_title', 'lead', 'body', 'note', 'order',
    ];
}
