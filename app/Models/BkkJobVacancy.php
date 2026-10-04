<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BkkJobVacancy extends Model
{
    /** Label lengkap tiap status (dipakai admin dan halaman publik). */
    public const STATUSES = [
        'OPEN'     => 'OPEN (Pendaftaran Berlangsung)',
        'UPCOMING' => 'UPCOMING (Akan Datang)',
        'SELESAI'  => 'SELESAI (Berakhir)',
        'ARSIP'    => 'ARSIP (Dokumentasi)',
    ];

    /** Urutan tampil: OPEN dulu, ARSIP terakhir. */
    public const RANK = ['OPEN' => 0, 'UPCOMING' => 1, 'SELESAI' => 2, 'ARSIP' => 3];

    public const EMPLOYMENT_TYPES = ['Full-Time', 'Part-Time', 'Kontrak', 'Magang', 'Freelance', 'Harian'];

    protected $table = 'bkk_job_vacancies';

    protected $fillable = [
        'title', 'company_name', 'location', 'employment_type',
        'status', 'deadline', 'apply_url', 'description', 'is_active',
    ];

    protected $casts = [
        'deadline'  => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Status yang dipakai di tampilan. Lowongan OPEN yang batas daftarnya
     * sudah lewat otomatis tampil sebagai SELESAI, tanpa perlu diubah manual.
     */
    public function getEffectiveStatusAttribute(): string
    {
        $status = strtoupper((string) $this->status);

        if (!array_key_exists($status, self::STATUSES)) {
            $status = 'OPEN';
        }

        if ($status === 'OPEN' && $this->deadline && $this->deadline->copy()->endOfDay()->isPast()) {
            return 'SELESAI';
        }

        return $status;
    }

    public function getAutoClosedAttribute(): bool
    {
        return strtoupper((string) $this->status) === 'OPEN' && $this->effective_status === 'SELESAI';
    }

    public function getApplyIsMailAttribute(): bool
    {
        return str_starts_with((string) $this->apply_url, 'mailto:');
    }

    /**
     * Urutan: OPEN, UPCOMING, SELESAI, ARSIP.
     * OPEN/UPCOMING: batas daftar paling dekat di atas (tanpa batas di bawah).
     * SELESAI/ARSIP: batas daftar terbaru di atas. Sisanya yang terbaru dibuat dulu.
     */
    public static function sortCollection(Collection $jobs): Collection
    {
        return $jobs->sort(function (self $a, self $b) {
            $sa = $a->effective_status;
            $sb = $b->effective_status;

            if ($sa !== $sb) {
                return self::RANK[$sa] <=> self::RANK[$sb];
            }

            if (in_array($sa, ['OPEN', 'UPCOMING'], true)) {
                $da = $a->deadline ? $a->deadline->getTimestamp() : PHP_INT_MAX;
                $db = $b->deadline ? $b->deadline->getTimestamp() : PHP_INT_MAX;
                if ($da !== $db) {
                    return $da <=> $db;
                }
            } else {
                $da = $a->deadline ? $a->deadline->getTimestamp() : 0;
                $db = $b->deadline ? $b->deadline->getTimestamp() : 0;
                if ($da !== $db) {
                    return $db <=> $da;
                }
            }

            return $b->id <=> $a->id;
        })->values();
    }
}
