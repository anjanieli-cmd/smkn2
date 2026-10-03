<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Support\DkvContent;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman DKV (yang sebelumnya ditulis langsung di file Blade)
 * ke kolom majors.details supaya bisa diedit dari admin.
 *
 * - Hanya mengisi jurusan yang kolom details-nya MASIH KOSONG, jadi hasil edit admin tidak tertimpa.
 * - Isi awal = isi asli halaman DKV lama.
 *
 * Jalankan:  php artisan db:seed --class=DkvContentSeeder
 */
class DkvContentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', DkvContent::CODE)->first();

        if ($major && empty($major->details)) {
            $major->details = DkvContent::defaults($major);
            $major->save();
        }
    }
}
