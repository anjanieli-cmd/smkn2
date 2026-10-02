<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PpdbItem extends Model
{
    /**
     * Daftar di halaman PPDB. Tiap section = satu tab di admin.
     *   tab    : nama tab            noun  : "Tambah <noun>"
     *   title  : label kolom judul   label : label kolom kecil (null = tidak dipakai)
     *   text   : label kolom teks (null = tidak dipakai)
     *   icon   : pakai ikon?         photo : pakai foto?
     */
    public const SECTIONS = [
        'definisi' => [
            'tab' => 'Pengertian', 'icon_tab' => 'fa-spell-check', 'noun' => 'kata',
            'title' => 'Judul kata (mis. Penerimaan)', 'label' => null, 'text' => 'Penjelasan',
            'icon' => false, 'photo' => false,
            'hint' => 'Kotak bernomor di bagian "Empat Kata". Nomor 1, 2, 3, … otomatis mengikuti urutan.',
        ],
        'jalur' => [
            'tab' => 'Jalur', 'icon_tab' => 'fa-route', 'noun' => 'jalur',
            'title' => 'Nama jalur', 'label' => 'Kuota (mis. Kuota ± 50%)', 'text' => 'Keterangan',
            'icon' => true, 'photo' => false,
            'hint' => 'Kartu jalur pendaftaran (Zonasi, Afirmasi, dst.).',
        ],
        'syarat' => [
            'tab' => 'Persyaratan', 'icon_tab' => 'fa-file-circle-check', 'noun' => 'berkas',
            'title' => 'Nama berkas', 'label' => null, 'text' => 'Keterangan',
            'icon' => true, 'photo' => false,
            'hint' => 'Daftar berkas yang harus disiapkan calon peserta didik.',
        ],
        'alur' => [
            'tab' => 'Alur', 'icon_tab' => 'fa-timeline', 'noun' => 'langkah',
            'title' => 'Judul langkah', 'label' => null, 'text' => 'Keterangan singkat',
            'icon' => false, 'photo' => false,
            'hint' => 'Langkah pendaftaran. Nomor lingkaran otomatis mengikuti urutan. Tata letak dirancang untuk 6 langkah.',
        ],
        'jadwal' => [
            'tab' => 'Jadwal', 'icon_tab' => 'fa-calendar-days', 'noun' => 'jadwal',
            'title' => 'Kegiatan', 'label' => 'Waktu (mis. Juni 2026)', 'text' => null,
            'icon' => false, 'photo' => false,
            'hint' => 'Baris tabel jadwal. Kolom "No" otomatis.',
        ],
        'jurusan' => [
            'tab' => 'Program Keahlian', 'icon_tab' => 'fa-graduation-cap', 'noun' => 'kompetensi',
            'title' => 'Nama kompetensi / judul kartu', 'label' => 'Label kecil (mis. TEKNOLOGI INFORMASI)', 'text' => 'Deskripsi',
            'icon' => false, 'photo' => true,
            'hint' => 'Kartu program keahlian. Foto dipotong dari tengah, ukuran landscape paling pas.',
        ],
        'faq' => [
            'tab' => 'FAQ', 'icon_tab' => 'fa-circle-question', 'noun' => 'pertanyaan',
            'title' => 'Pertanyaan', 'label' => null, 'text' => 'Jawaban',
            'icon' => false, 'photo' => false,
            'hint' => 'Pertanyaan pertama otomatis terbuka saat halaman dibuka.',
        ],
    ];

    protected $table = 'ppdb_items';

    protected $fillable = ['section', 'icon', 'title', 'label', 'text', 'photo', 'order', 'is_active'];

    protected $casts = [
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeOfSection(Builder $query, string $section): Builder
    {
        return $query->where('section', $section);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(get: fn () => PpdbSetting::imageUrl($this->photo));
    }
}
