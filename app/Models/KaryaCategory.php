<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaCategory extends Model
{
    protected $table = 'karya_categories';

    protected $fillable = ['key', 'label', 'icon', 'description', 'order'];

    protected $casts = ['order' => 'integer'];
}
