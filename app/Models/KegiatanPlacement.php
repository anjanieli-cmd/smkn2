<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanPlacement extends Model
{
    public const SLOTS = ['featured', 'pick_big', 'pick_small'];

    /** Jumlah slot tetap per bagian, sesuai tampilan halaman publik. */
    public const SLOT_CAPACITY = [
        'featured'   => 1,
        'pick_big'   => 1,
        'pick_small' => 4,
    ];

    protected $table = 'kegiatan_placements';

    protected $fillable = ['slot', 'position', 'album_id', 'label'];

    protected $casts = ['position' => 'integer'];

    public function album()
    {
        return $this->belongsTo(KegiatanAlbum::class, 'album_id');
    }
}
