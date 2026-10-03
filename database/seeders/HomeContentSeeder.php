<?php

namespace Database\Seeders;

use App\Models\HomeAchievement;
use App\Models\HomeIndustryLogo;
use Illuminate\Database\Seeder;

/**
 * Data awal bagian beranda: logo Kerja Sama Industri dan kartu Prestasi.
 * Isinya sama persis dengan yang sebelumnya tertulis manual di welcome.blade.php.
 * Aman dijalankan berulang kali: tabel yang sudah berisi tidak ditimpa.
 */
class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        if (HomeIndustryLogo::count() === 0) {
            $rows = [
                ['Hummatech',                           'images/industri/hummatech.png'],
                ['PrimaFood',                           'images/industri/primafood.png'],
                ['AnekaPay',                            'images/industri/anekapay.png'],
                ['Minarsih',                            'images/industri/minarsih.png'],
                ['DigiproSB',                           'images/industri/digiprosb.png'],
                ['Smartfren',                           'images/industri/smartfren.png'],
                ['HSP',                                 'images/industri/hsp.png'],
                ['Sido Jodo',                           'images/industri/sido-jodo.png'],
                ['Maspion IT',                          'images/industri/maspion-it.png'],
                ['MediaTama',                           'images/industri/media-tama.png'],
                ['Otak Kanan',                          'images/industri/otak-kanan.png'],
                ['Apika Finance',                       'images/industri/apika-finance.png'],
                ['Rumah Sakit Islam Sakinah Mojokerto', 'images/industri/rs-islam-sakinah-mojokerto.png'],
            ];
            foreach ($rows as $i => [$name, $logo]) {
                HomeIndustryLogo::create(['name' => $name, 'logo' => $logo, 'is_active' => true, 'order' => $i]);
            }
        }

        if (HomeAchievement::count() === 0) {
            $rows = [
                [
                    'images/lks.jpeg', 'Medali Perak — Nasional', 'LKS Nasional', 'Patisserie & Confectionery',
                    'SMK Negeri 2 Mojokerto meraih medali perak pada Lomba Kompetensi Siswa SMK bidang patisserie and confectionery tingkat nasional.',
                    '2024', 'Tingkat Nasional',
                ],
                [
                    'images/adiwiyata.jpeg', 'Penghargaan — Jawa Timur', 'SMKN 2 Mojokerto', 'Raih Adiwiyata Provinsi',
                    'SMK Negeri 2 Mojokerto meraih penghargaan Sekolah Adiwiyata Provinsi Jawa Timur.',
                    '2025', 'Lingkungan',
                ],
                [
                    'images/klic.jpeg', 'Prestasi — KLIC', 'Prestasi', 'Program KLIC',
                    'SMK Negeri 2 Mojokerto kembali menorehkan prestasi melalui program Korea E-Learning Improvement Cooperation (KLIC).',
                    '2025', 'E-Learning',
                ],
            ];
            foreach ($rows as $i => [$image, $tag, $title, $subtitle, $desc, $year, $meta]) {
                HomeAchievement::create([
                    'image' => $image, 'tag' => $tag, 'title' => $title, 'subtitle' => $subtitle,
                    'description' => $desc, 'year' => $year, 'meta_label' => $meta,
                    'is_active' => true, 'order' => $i,
                ]);
            }
        }
    }
}
