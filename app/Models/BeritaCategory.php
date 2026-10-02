<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaCategory extends Model
{
    public const COLORS = ['sekolah', 'siswa', 'prestasi', 'kegiatan', 'akademik', 'ekstrakurikuler', 'humas'];

    protected $table = 'berita_categories';

    protected $fillable = ['key', 'label', 'color', 'icon', 'order'];

    protected $casts = ['order' => 'integer'];
}
