<?php

namespace App\Models;

use App\Support\KegiatanMedia;
use Illuminate\Database\Eloquent\Model;

class KegiatanPhoto extends Model
{
    protected $table = 'kegiatan_photos';

    protected $fillable = ['album_id', 'path', 'order'];

    protected $casts = ['order' => 'integer'];

    public function album()
    {
        return $this->belongsTo(KegiatanAlbum::class, 'album_id');
    }

    public function getUrlAttribute(): string
    {
        return KegiatanMedia::url($this->path);
    }
}
