<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Support\RplContent;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman RPL (yang sebelumnya ditulis langsung di file Blade)
 * ke kolom majors.details supaya bisa diedit dari admin.
 *
 * - Hanya mengisi jurusan yang kolom details-nya MASIH KOSONG, jadi hasil edit admin tidak tertimpa.
 * - Isi awal = isi asli halaman RPL lama.
 *
 * Jalankan:  php artisan db:seed --class=RplContentSeeder
 */
class RplContentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', RplContent::CODE)->first();

        if ($major && empty($major->details)) {
            $major->details = RplContent::defaults($major);
            $major->save();
        }
    }
}
