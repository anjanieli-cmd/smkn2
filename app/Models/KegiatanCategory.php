<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanCategory extends Model
{
    protected $table = 'kegiatan_categories';

    protected $fillable = ['key', 'label', 'icon', 'order'];

    protected $casts = ['order' => 'integer'];
}
