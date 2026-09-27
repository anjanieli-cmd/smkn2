<?php

namespace App\Enums;

enum JobVacancyStatus: string
{
    case OPEN = 'OPEN';
    case UPCOMING = 'UPCOMING';
    case SELESAI = 'SELESAI';
    case ARSIP = 'ARSIP';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Pendaftaran Masih Berlangsung',
            self::UPCOMING => 'Rekrutmen Akan Datang',
            self::SELESAI => 'Pendaftaran Telah Berakhir',
            self::ARSIP => 'Dokumentasi Rekrutmen/Kegiatan',
        };
    }
}
