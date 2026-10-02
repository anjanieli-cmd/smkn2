<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StrukturMember extends Model
{
    /** Level bagan: nomor => [label lencana, ikon]. Tetap di kode supaya tata letak halaman publik konsisten. */
    public const LEVELS = [
        1 => ['Level 1 — Pimpinan', 'fa-user-tie'],
        2 => ['Level 2 — Wakil Kepala Sekolah', 'fa-users-gear'],
        3 => ['Level 3 — Unit Pelaksana & Koordinator', 'fa-layer-group'],
    ];

    /** Bidang = kunci chip filter di halaman publik. Chip hanya tampil kalau ada orang aktif di bidang itu. */
    public const BIDANG = [
        'pimpinan'  => 'Pimpinan',
        'kurikulum' => 'Kurikulum',
        'kesiswaan' => 'Kesiswaan',
        'sapras'    => 'Sarana & Prasarana',
        'humas'     => 'Humas & Industri',
        'keuangan'  => 'Keuangan',
        'keahlian'  => 'Kompetensi Keahlian',
    ];

    protected $table = 'struktur_members';

    protected $fillable = [
        'level', 'bidang', 'position', 'person', 'badge', 'unit', 'description',
        'icon', 'photo', 'tasks', 'note', 'order', 'is_active',
    ];

    protected $casts = [
        'level'     => 'integer',
        'order'     => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('level')->orderBy('order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * URL foto.
     * - Foto lama di public/ (mis. "images/struktur/melati.png") -> asset()
     * - Foto hasil upload admin (disk public) -> Storage url
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::make(get: function () {
            $path = $this->photo;
            if (!$path) {
                return null;
            }
            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }
            if (file_exists(public_path($path))) {
                return asset($path);
            }
            return Storage::disk('public')->url($path);
        });
    }

    /** Tugas & tanggung jawab sebagai array (satu baris = satu tugas). */
    public function tasksList(): array
    {
        return array_values(array_filter(array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', (string) $this->tasks) ?: []
        ), fn ($t) => $t !== ''));
    }
}
