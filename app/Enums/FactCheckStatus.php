<?php

namespace App\Enums;

enum FactCheckStatus: string
{
    case VERIFIED = 'VERIFIED';
    case FALSE = 'FALSE';
    case UNCONFIRMED = 'UNCONFIRMED';

    public function label(): string
    {
        return match ($this) {
            self::VERIFIED => 'Terverifikasi Benar (Fakta)',
            self::FALSE => 'Tidak Benar (Hoaks)',
            self::UNCONFIRMED => 'Belum Terkonfirmasi',
        };
    }
}
