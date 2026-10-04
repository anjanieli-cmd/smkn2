<?php

namespace Database\Seeders;

use App\Models\HomeBestAlumni;
use App\Models\HomeMajor;
use App\Models\HomePtn;
use Illuminate\Database\Seeder;

/**
 * Data awal bagian beranda: Jurusan Unggulan, Lulusan Terbaik, dan Lulusan PTN.
 * Isinya sama persis dengan yang sebelumnya tertulis manual di welcome.blade.php.
 * Aman dijalankan berulang kali: tabel yang sudah berisi tidak ditimpa.
 */
class HomeSectionsSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan = urutan tampil di carousel (kiri ke kanan)
        if (HomeMajor::count() === 0) {
            $rows = [
                ['RPL',     'Rekayasa Perangkat Lunak',              'images/RPL.png',     '/keahlian/rpl',     '#DB1320'],
                ['KULINER', 'Kuliner',                               'images/Kuliner.png', '/keahlian/kuliner', '#FE8D03'],
                ['LPS',     'Layanan Perbankan Syariah',             'images/LPS.png',     '/keahlian/lps',     '#049747'],
                ['DKV',     'Desain Komunikasi Visual',              'images/DKV.png',     '/keahlian/dkv',     '#D80A86'],
                ['APHP',    'Agribisnis Pengolahan Hasil Pertanian', 'images/APHP.png',    '/keahlian/aphp',    '#E8A800'],
            ];
            foreach ($rows as $i => [$abbr, $name, $image, $url, $color]) {
                HomeMajor::create([
                    'abbr' => $abbr, 'full_name' => $name, 'image' => $image, 'url' => $url,
                    'color' => $color, 'is_active' => true, 'order' => $i,
                ]);
            }
        }

        if (HomeBestAlumni::count() === 0) {
            $rows = [
                ['RPL', 'Rekayasa Perangkat Lunak', 'Rovino Ramadhani', '2024', 'RPL / 2024', 'images/rovino.png'],
                ['KULINER', 'Kuliner', 'Ahmed Husein Jalili', '2025', 'KUL / 2025', 'images/husein.png'],
                ['LPS', 'Layanan Perbankan Syariah', 'Zidana Khoiron Alif', '2026', 'LPS / 2026', 'images/zidan.png'],
                ['DKV', 'Desain Komunikasi Visual', 'Lola Devina Amidjaja', '2026', 'DKV / 2026', 'images/lola.jpeg'],
                ['APHP', 'Agribisnis Pengolahan Hasil Pertanian', 'Faisal Fikri Rushdi Shihab', '2026', 'APHP / 2026', 'images/faisal.png'],
            ];
            foreach ($rows as $i => [$abbr, $major, $name, $year, $code, $photo]) {
                HomeBestAlumni::create([
                    'major_abbr' => $abbr, 'major_name' => $major, 'name' => $name, 'year' => $year,
                    'code' => $code, 'photo' => $photo, 'is_active' => true, 'order' => $i,
                ]);
            }
        }

        if (HomePtn::count() === 0) {
            $rows = [
                ['Institut Teknologi Sepuluh Nopember', 'images/ptn/its.png', [
                    ['Lola Devina Amidjaja', 'Desain Produk', 'XII DKV 1', 'SNBP'],
                ]],
                ['Universitas Brawijaya', 'images/ptn/brawijaya.png', [
                    ['Linda Khairunnisa Az Zahra', 'Agribisnis', 'XII APHP 1', 'SNBP'],
                ]],
                ['Politeknik Negeri Malang', 'images/ptn/polinema.png', [
                    ['Septy Wahyu Putri Ramadhani', 'Teknologi Industri Pangan', 'XII APHP 2', 'SNBP'],
                ]],
                ['Universitas Negeri Malang', 'images/ptn/um-malang.png', [
                    ['Muhammad Zildhan Adinata Mulyano', 'Animasi', 'XII DKV 2', 'SNBP'],
                ]],
                ['Universitas Negeri Surabaya', 'images/ptn/unesa.png', [
                    ['Reyfan Akbar Lazuardianto', 'Desain Komunikasi Visual', 'XII DKV 2', 'SNBP'],
                    ['Reisyah Aulia Ramadhani', 'Pendidikan Teknologi Informasi', 'XII LPS 2', 'SNBT'],
                ]],
                ['Universitas Trunojoyo Madura', 'images/ptn/trunojoyo.png', [
                    ['Zahira Masfirah Fauzy', 'Sistem Informasi', 'XII RPL 1', 'SNBP'],
                    ['Reivaldo Aditya Prayoga', 'Teknik Informatika', 'XII RPL 1', 'SNBT'],
                ]],
                ['Politeknik Negeri Jember', 'images/ptn/polije.png', [
                    ['Septy Wahyu Putri Ramadhani', 'Teknologi Industri Pangan', 'XII APHP 2', 'SNBP'],
                    ['Duta Pandu Pratama', 'Teknik Informatika', 'XII RPL 3', 'SNBT'],
                ]],
                ['Universitas Pembangunan Nasional Veteran Jawa Timur', 'images/ptn/upn-jatim.png', [
                    ['Aghista Liany Qurrota A\'yunina', 'Sistem Informasi', 'XII RPL 1', 'SNBP'],
                    ['Vika Anjani Irawan', 'Informatika', 'XII RPL 2', 'SNBT'],
                ]],
                ['Universitas Islam Negeri Surabaya', 'images/ptn/uinsa.png', [
                    ['Iffasya Adinda B.', 'Program studi belum dicantumkan', 'XII RPL 2', 'SNBP'],
                    ['Novita Cahya Sawana', 'Ilmu Ekonomi', 'XII LPS 1', 'SNBT'],
                ]],
                ['Institut Seni Indonesia Surakarta', 'images/ptn/isi-surakarta.png', [
                    ['Graha Dinda Agil .N', 'Fotografi', 'XII DKV 2', 'SNBP'],
                ]],
                ['Universitas Airlangga Surabaya', 'images/ptn/unair.png', [
                    ['Sarzy Sifra Septiana', 'Perpajakan', 'XII PS 2', 'SNBP'],
                ]],
                ['Politeknik Elektronika Negeri Surabaya', 'images/ptn/pens.png', [
                    ['Achmad Baharudin', 'Teknik Elektro Industri', 'XII RPL 1', 'SNBT'],
                ]],
                ['Politeknik Perkapalan Negeri Surabaya', 'images/ptn/ppns.png', [
                    ['Ryan Dwi Anugrah', 'Teknik Pengelasan', 'XII RPL 3', 'SNBT'],
                ]],
                ['Universitas Islam Negeri Malang', 'images/ptn/uin-malang.png', [
                    ['Nisreena El Yanti', 'Akuntansi', 'XII LPS 2', 'SNBT'],
                ]],
                ['Universitas Jember', 'images/ptn/unej.png', [
                    ['Barnessa Maheswari Yudianto', 'Agronomi', 'XII APHP 2', 'SNBT'],
                ]],
            ];
            foreach ($rows as $i => [$name, $logo, $students]) {
                HomePtn::create([
                    'name'      => $name,
                    'logo'      => $logo,
                    'students'  => array_map(fn ($s) => [
                        'name' => $s[0], 'program' => $s[1], 'class_label' => $s[2], 'path' => $s[3],
                    ], $students),
                    'is_active' => true,
                    'order'     => $i,
                ]);
            }
        }
    }
}
