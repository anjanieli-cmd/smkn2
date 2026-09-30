<?php

namespace Database\Seeders;

use App\Models\SchoolAchievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public static function seedIfEmpty(): void
    {
        $initialItems = [
            [
                'title'       => 'Juara 2 Hackathon Pelajar Nusantara',
                'level'       => 'Nasional',
                'year'        => '2026',
                'winner_name' => 'Tim Dev SKANEDA (RPL)',
                'description' => 'Kompetisi pembuatan aplikasi solusi smart city antar pelajar se-Indonesia.',
                'image_url'   => 'images/rpl1.jpeg',
            ],
            [
                'title'       => 'Juara 1 Lomba Desain Grafis DKV Mojokerto',
                'level'       => 'Kota/Kabupaten',
                'year'        => '2026',
                'winner_name' => 'Ahmad Zaki (XI DKV)',
                'description' => 'Lomba desain poster kreatif peringatan Hari Pendidikan Nasional.',
                'image_url'   => 'images/dkv1.jpeg',
            ],
            [
                'title'       => 'Juara 1 LKS Web Technologies Jawa Timur',
                'level'       => 'Provinsi',
                'year'        => '2025',
                'winner_name' => 'Rovino Ramadhani (RPL)',
                'description' => 'Lomba Kompetensi Siswa SMK Tingkat Provinsi Jawa Timur 2025 di bidang pengembangan web.',
                'image_url'   => 'images/lks.jpeg',
            ],
            [
                'title'       => 'Penghargaan Sekolah Adiwiyata Mandiri',
                'level'       => 'Nasional',
                'year'        => '2025',
                'winner_name' => 'Tim Lingkungan SKANEDA',
                'description' => 'Penghargaan lingkungan hidup tingkat nasional oleh Kementerian Lingkungan Hidup dan Kehutanan.',
                'image_url'   => 'images/adiwiyata.jpeg',
            ],
            [
                'title'       => 'Medali Emas O2SN Karate Putri',
                'level'       => 'Provinsi',
                'year'        => '2025',
                'winner_name' => 'Siti Nurhaliza (X RPL 2)',
                'description' => 'Olimpiade Olahraga Siswa Nasional (O2SN) SMK Tingkat Provinsi Jawa Timur.',
                'image_url'   => 'images/galeri/perjusa.jpg',
            ],
            [
                'title'       => 'Juara 1 FIKSI Bidang Boga & Olahan Pangan',
                'level'       => 'Nasional',
                'year'        => '2024',
                'winner_name' => 'Tim APHP SKANEDA',
                'description' => 'Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI) Kemendikbudristek.',
                'image_url'   => 'images/galeri/fiksi.jpg',
            ],
        ];

        foreach ($initialItems as $item) {
            $achv = SchoolAchievement::firstOrNew(['title' => $item['title']]);
            $achv->fill($item)->save();
        }
    }

    public function run(): void
    {
        self::seedIfEmpty();
    }
}
