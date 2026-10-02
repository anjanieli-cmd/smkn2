<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MajorSeeder extends Seeder
{
    public static function seedIfEmpty(): void
    {
        if (Major::count() > 0) {
            return;
        }

        $majors = [
            [
                'code' => 'RPL',
                'name' => 'Rekayasa Perangkat Lunak',
                'slug' => 'rekayasa-perangkat-lunak',
                'icon_url' => 'images/RPL.png',
                'description' => 'Konsentrasi keahlian pemrograman web, mobile, dan pengembangan software.',
                'is_active' => true,
            ],
            [
                'code' => 'DKV',
                'name' => 'Desain Komunikasi Visual',
                'slug' => 'desain-komunikasi-visual',
                'icon_url' => 'images/DKV.png',
                'description' => 'Fokus pada grafis, ilustrasi, animasi, videografi, dan desain kreatif.',
                'is_active' => true,
            ],
            [
                'code' => 'APHP',
                'name' => 'Agribisnis Pengolahan Hasil Pertanian',
                'slug' => 'agribisnis-pengolahan-hasil-pertanian',
                'icon_url' => 'images/APHP.png',
                'description' => 'Inovasi pengolahan hasil pertanian dan pangan modern.',
                'is_active' => true,
            ],
            [
                'code' => 'KULINER',
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'icon_url' => 'images/Kuliner.png',
                'description' => 'Seni tata boga, manajemen kuliner, dan tata hidang profesional.',
                'is_active' => true,
            ],
            [
                'code' => 'LPS',
                'name' => 'Layanan Perbankan Syariah',
                'slug' => 'layanan-perbankan-syariah',
                'icon_url' => 'images/LPS.png',
                'description' => 'Manajemen keuangan syariah dan administrasi perbankan.',
                'is_active' => true,
            ],
        ];

        foreach ($majors as $data) {
            $existing = Major::where('code', $data['code'])->first();
            if (!$existing) {
                Major::create($data);
            } else {
                if (empty($existing->icon_url) || str_starts_with($existing->icon_url, 'fas ')) {
                    $existing->update(['icon_url' => $data['icon_url']]);
                }
            }
        }
    }

    public function run(): void
    {
        self::seedIfEmpty();
    }
}
