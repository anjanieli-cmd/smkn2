<?php

namespace Database\Seeders;

use App\Models\KaryaCategory;
use App\Models\KaryaWork;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman Karya Siswa yang sebelumnya hardcoded ke database.
 * Foto memakai file yang sudah ada di public/images/karya/ (tidak dipindah).
 * Hanya mengisi tabel yang masih kosong, jadi aman diulang dan tidak
 * menimpa hasil edit admin.
 */
class KaryaSeeder extends Seeder
{
    public function run(): void
    {
        if (!KaryaCategory::query()->exists()) {
            foreach ([
                ['aplikasi-it', 'Aplikasi & IT', 'fa-code', 'Aplikasi web, mobile, dan sistem informasi buatan siswa RPL.'],
                ['kuliner', 'Kuliner', 'fa-utensils', 'Hidangan nusantara, pastry & bakery, dan inovasi menu.'],
                ['desain-visual', 'Desain Visual', 'fa-palette', 'Desain grafis, ilustrasi, branding, dan media promosi.'],
                ['produk-olahan', 'Produk Olahan', 'fa-seedling', 'Pengolahan hasil pertanian & perikanan bernilai tambah.'],
                ['bisnis-keuangan', 'Bisnis & Keuangan', 'fa-chart-line', 'Layanan perbankan syariah & administrasi keuangan.'],
            ] as $i => [$key, $label, $icon, $desc]) {
                KaryaCategory::create(['key' => $key, 'label' => $label, 'icon' => $icon, 'description' => $desc, 'order' => $i]);
            }
        }

        if (!KaryaWork::query()->exists()) {
            $aphp = ['Agribisnis Pengolahan Hasil Pertanian', 'fa-seedling', 'APHP'];
            $rpl  = ['Rekayasa Perangkat Lunak', 'fa-laptop-code', 'RPL'];
            $kul  = ['Kuliner', 'fa-utensils', 'Kuliner'];
            $dkv  = ['Desain Komunikasi Visual', 'fa-palette', 'DKV'];

            // [judul, deskripsi, foto, kategori, tag, ikon tag, siswa, jurusan, tahun, tampil di produk?]
            $rows = [
                ['MultiMie', 'Mi instan praktis dengan bumbu siap seduh — produk inovasi siswa APHP.',
                    'multimie.jpeg', 'produk-olahan', 'Makanan', 'fa-utensils', 'Tim APHP Angkatan 2023', $aphp, '2025', true],
                ['Aplikasi Tambal Ban Express', 'Mengembangkan aplikasi layanan tambal ban berbasis web untuk memudahkan pemesanan dan pelayanan secara cepat dan praktis.',
                    'tambalbanexpres.jpeg', 'aplikasi-it', 'Aplikasi & IT', 'fa-code', 'Kelas XII RPL', $rpl, '2024', false],
                ['Sari Bunga Telang', 'Minuman herbal alami dari ekstrak bunga telang dengan warna biru khas dan cita rasa menyegarkan — inovasi olahan kreatif siswa APHP.',
                    'bungatelang.jpeg', 'produk-olahan', 'Minuman', 'fa-bottle-water', 'Kelas XII APHP', $aphp, '2024', true],
                ['Pastry & Bakery Kreatif', 'Pembuatan aneka kue dan roti dengan teknik dan resep pastry yang tepat, tampil cantik dan lezat.',
                    'pastry-kuliner.jpeg', 'kuliner', 'Makanan', 'fa-utensils', 'Kelas XI Kuliner', $kul, '2025', true],
                ['Nirmana 3D', 'Mengeksplorasi bentuk, ruang, tekstur, dan komposisi untuk menghasilkan karya tiga dimensi yang harmonis dan menarik.',
                    'nirmana.jpeg', 'desain-visual', 'Produk Kreatif', 'fa-palette', 'Kelas XII DKV', $dkv, '2025', true],
                ['Maja Mojo', 'Minuman olahan berbahan dasar buah mojo dengan cita rasa unik, inovasi kreatif siswa RPL dalam memanfaatkan bahan pangan lokal.',
                    'estrakbuahmojo.jpeg', 'produk-olahan', 'Minuman', 'fa-bottle-water', 'Tim RPL', $rpl, '2024', true],
                ['Produk Olahan Hasil Pertanian', 'Mengolah bahan pangan menjadi berbagai produk roti bernilai tambah — dari roti manis, roti isi, hingga kreasi roti inovatif.',
                    'vocamo.png', 'produk-olahan', 'Produk Olahan', 'fa-seedling', 'APHP', $aphp, '2024', false],
                ['Bei Mie', 'Mie unik berbahan dasar daun murbei yang alami dan kaya manfaat, perpaduan cita rasa lezat dengan pilihan yang lebih sehat.',
                    'bei-mie.jpeg', 'kuliner', 'Makanan', 'fa-utensils', 'Kelas XI Kuliner', $kul, '2025', true],
            ];

            foreach ($rows as $i => [$title, $desc, $file, $cat, $tag, $tagIcon, $student, $major, $year, $inProducts]) {
                KaryaWork::create([
                    'title'            => $title,
                    'description'      => $desc,
                    'photo'            => 'images/karya/' . $file,
                    'category_key'     => $cat,
                    'tag_label'        => $tag,
                    'tag_icon'         => $tagIcon,
                    'student_label'    => $student,
                    'major_label'      => $major[0],
                    'major_icon'       => $major[1],
                    'major_short'      => $major[2],
                    'year_label'       => $year,
                    'show_in_slider'   => true,
                    'show_in_products' => $inProducts,
                    'order'            => $i,
                    'is_active'        => true,
                ]);
            }
        }
    }
}
