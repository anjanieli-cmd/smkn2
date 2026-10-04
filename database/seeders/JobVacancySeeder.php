<?php

namespace Database\Seeders;

use App\Enums\JobVacancyStatus;
use App\Models\BkkJobVacancy;
use App\Models\JobVacancy;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data lowongan kerja BKK berdasarkan informasi resmi SMKN 2 Mojokerto
     * Source: https://smkn2mojokerto.sch.id/category/lowongan-kerja
     */
    public function run(): void
    {
        $vacancies = [
            [
                'title' => 'Lowongan Kerja Barista & Cook',
                'company_name' => 'Mitra Hospitality & Kuliner BKK SKANEDA',
                'location' => 'Mojokerto & Surabaya',
                'employment_type' => 'Full-Time',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/read/lowongan-kerja-barista-and-cook',
                'description' => 'Bursa Kerja Khusus (BKK) SMK Negeri 2 Mojokerto membuka rekrutmen lowongan kerja untuk posisi Barista dan Cook. Terbuka bagi alumni dan lulusan konsentrasi Kuliner, Agribisnis Pengolahan Hasil Pertanian (APHP), serta umum yang memiliki minat di bidang Food & Beverage.',
            ],
            [
                'title' => 'Rekrutmen BTPN Syariah & Program Wirausaha Alumni',
                'company_name' => 'PT Bank BTPN Syariah Tbk',
                'location' => 'Mojokerto & Sekitarnya',
                'employment_type' => 'Full-Time',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/read/rekap-kegiatan-bkk-smkn-2-mojokerto-tahun-2024',
                'description' => 'Perekrutan massal alumni SMKN 2 Mojokerto untuk posisi Community Officer di PT Bank BTPN Syariah Tbk. Membuka peluang karir bagi lulusan Layanan Perbankan Syariah (LPS), RPL, dan seluruh jurusan untuk pemberdayaan masyarakat inklusi.',
            ],
            [
                'title' => 'Program Magang Kerja Jepang (IM Japan & LPK Nagasaki)',
                'company_name' => 'IM Japan & LPK Nagasaki',
                'location' => 'Jepang / Indonesia',
                'employment_type' => 'Magang',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(4)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/read/rekap-kegiatan-bkk-smkn-2-mojokerto-tahun-2023',
                'description' => 'Pengarahan dan seleksi program magang kerja ke Jepang kerja sama BKK SMKN 2 Mojokerto dengan IM Japan dan LPK Nagasaki. Memberikan kesempatan kerja internasional bagi alumni berprestasi.',
            ],
            [
                'title' => 'Rekrutmen Operator & Teknisi PT Surabaya Autocomp Indonesia (SAI)',
                'company_name' => 'PT. Surabaya Autocomp Indonesia (SAI)',
                'location' => 'Mojokerto - Pasuruan',
                'employment_type' => 'Full-Time',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/read/rekap-kegiatan-bkk-smkn-2-mojokerto-tahun-2022',
                'description' => 'Rekrutmen tenaga kerja industri manufaktur wiring harness PT Surabaya Autocomp Indonesia (SAI) berkolaborasi dengan BKK SMKN 2 Mojokerto dan Dinas Tenaga Kerja Kota Mojokerto.',
            ],
            [
                'title' => 'Perekrutan Alumni PT Catur Pilar Sejahtera',
                'company_name' => 'PT. Catur Pilar Sejahtera',
                'location' => 'Jawa Timur',
                'employment_type' => 'Kontrak',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/read/rekap-kegiatan-bkk-smkn-2-mojokerto-tahun-2023',
                'description' => 'Kunjungan tim BKK SMKN 2 Mojokerto dan penandatanganan kerja sama rekrutmen alumni dengan PT Catur Pilar Sejahtera untuk penyerapan tenaga kerja lulusan kejuruan.',
            ],
            [
                'title' => 'Lowongan Junior Web Developer & Graphic Designer',
                'company_name' => 'Mitra DUDI Software & Creative Agency Skaneda',
                'location' => 'Mojokerto & Remote',
                'employment_type' => 'Full-Time',
                'status' => 'OPEN',
                'deadline' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'apply_url' => 'https://smkn2mojokerto.sch.id/category/lowongan-kerja',
                'description' => 'Peluang karir bagi alumni lulusan Rekayasa Perangkat Lunak (RPL) dan Desain Komunikasi Visual (DKV) SMKN 2 Mojokerto sebagai Junior Web Developer, Frontend Programmer, dan Graphic Designer.',
            ],
        ];

        // 1. Seed BkkJobVacancy model (Tabel bkk_job_vacancies)
        foreach ($vacancies as $v) {
            BkkJobVacancy::updateOrCreate(
                [
                    'title' => $v['title'],
                    'company_name' => $v['company_name'],
                ],
                [
                    'location' => $v['location'],
                    'employment_type' => $v['employment_type'],
                    'status' => $v['status'],
                    'deadline' => $v['deadline'],
                    'apply_url' => $v['apply_url'],
                    'description' => $v['description'],
                    'is_active' => true,
                ]
            );
        }

        // 2. Seed JobVacancy model (Tabel job_vacancies) jika ada
        foreach ($vacancies as $v) {
            JobVacancy::updateOrCreate(
                [
                    'title' => $v['title'],
                    'company_name' => $v['company_name'],
                ],
                [
                    'location' => $v['location'],
                    'description' => $v['description'],
                    'apply_url' => $v['apply_url'],
                    'deadline' => $v['deadline'],
                    'status' => JobVacancyStatus::OPEN,
                ]
            );
        }
    }
}
