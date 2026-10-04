<?php

namespace Database\Seeders;

use App\Models\BkkIndustry;
use Illuminate\Database\Seeder;

/**
 * Mengisi 5 mitra industri yang sebelumnya tampil sebagai data bawaan di halaman BKK.
 * Hanya jalan kalau tabel masih kosong, jadi tidak menimpa hasil edit admin.
 * Lowongan sengaja tidak di-seed — diisi lewat admin.
 */
class BkkSeeder extends Seeder
{
    public function run(): void
    {
        if (BkkIndustry::query()->exists()) {
            return;
        }

        $rows = [
            ['PT Telkom Indonesia (Persero) Tbk', 'IT & Telekomunikasi', 'PKL, Kelas Industri & Rekrutmen Lulusan'],
            ['Bank Syariah Indonesia (BSI)', 'Keuangan & Perbankan', 'Magang Industri & Rekrutmen Alumni'],
            ['Hotel Vasa Surabaya', 'Hospitality & Kuliner', 'Praktik Kerja Lapangan Kuliner'],
            ['PT Cheil Jedang Indonesia', 'Manufaktur & Olahan Pangan', 'Kemitraan Rekrutmen & Kunjungan Industri'],
            ['PT Perhutani Anugerah Kimia', 'Industri Hasil Hutan & Kimia', 'Kerja Sama Penyerapan Lulusan Vokasi'],
        ];

        foreach ($rows as $i => [$name, $field, $scope]) {
            BkkIndustry::create([
                'company_name'      => $name,
                'field_of_work'     => $field,
                'partnership_scope' => $scope,
                'order'             => $i,
                'is_active'         => true,
            ]);
        }
    }
}
