<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Support\LpsContent;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman LPS (yang sebelumnya ditulis langsung di file Blade)
 * ke kolom majors.details supaya bisa diedit dari admin.
 *
 * - Hanya mengisi jurusan yang kolom details-nya MASIH KOSONG, jadi hasil edit admin tidak tertimpa.
 * - Isi awal = isi asli halaman LPS lama.
 *
 * Jalankan:  php artisan db:seed --class=LpsContentSeeder
 */
class LpsContentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', LpsContent::CODE)->first();

        if ($major && empty($major->details)) {
            $major->details = LpsContent::defaults($major);
            $major->save();
        }
    }
}
