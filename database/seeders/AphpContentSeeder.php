<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Support\AphpContent;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman APHP (yang sebelumnya ditulis langsung di file Blade)
 * ke kolom majors.details supaya bisa diedit dari admin.
 *
 * - Hanya mengisi jurusan yang kolom details-nya MASIH KOSONG, jadi hasil edit admin tidak tertimpa.
 * - Isi awal = isi asli halaman APHP lama.
 *
 * Jalankan:  php artisan db:seed --class=AphpContentSeeder
 */
class AphpContentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', AphpContent::CODE)->first();

        if ($major && empty($major->details)) {
            $major->details = AphpContent::defaults($major);
            $major->save();
        }
    }
}
