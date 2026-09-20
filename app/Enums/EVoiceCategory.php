<?php

namespace App\Enums;

enum EVoiceCategory: string
{
    case ASPIRASI = 'ASPIRASI';
    case KRITIK = 'KRITIK';
    case SARAN = 'SARAN';
    case PENGADUAN = 'PENGADUAN';
    case AKADEMIK = 'Akademik';
    case FASILITAS = 'Fasilitas';
    case KEDISIPLINAN = 'Kedisiplinan';
    case PERUNDUNGAN = 'Perundungan';
    case LAYANAN = 'Layanan';
    case LAYANAN_SEKOLAH = 'Layanan Sekolah';
    case LAINNYA = 'Lainnya';
}
