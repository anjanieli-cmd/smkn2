<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Support\KulinerContent;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman KULINER (yang sebelumnya ditulis langsung di file Blade)
 * ke kolom majors.details supaya bisa diedit dari admin.
 *
 * - Hanya mengisi jurusan yang kolom details-nya MASIH KOSONG, jadi hasil edit admin tidak tertimpa.
 * - Isi awal = isi asli halaman KULINER lama.
 *
 * Jalankan:  php artisan db:seed --class=KulinerContentSeeder
 */
class KulinerContentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', KulinerContent::CODE)->first();

        if ($major && empty($major->details)) {
            $major->details = KulinerContent::defaults($major);
            $major->save();
        }
    }
}
