<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaPlacement extends Model
{
    public const SLOTS = ['featured', 'side', 'most_read'];

    /** Jumlah slot tetap per bagian, sesuai tampilan halaman publik. */
    public const SLOT_CAPACITY = [
        'featured'  => 1,
        'side'      => 4,
        'most_read' => 5,
    ];

    protected $table = 'berita_placements';

    protected $fillable = ['slot', 'position', 'article_id'];

    protected $casts = ['position' => 'integer'];

    public function article()
    {
        return $this->belongsTo(BeritaArticle::class, 'article_id');
    }
}
