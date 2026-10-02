<?php

namespace Database\Seeders;

use App\Models\PpdbItem;
use Illuminate\Database\Seeder;

/**
 * Mengisi daftar di halaman PPDB dengan konten yang sebelumnya hardcoded.
 * Foto memakai file lama di public/images (tidak perlu dipindah).
 * Hanya berjalan kalau tabel masih kosong, jadi aman diulang dan tidak
 * menimpa hasil edit admin. Teks judul tidak perlu di-seed (ada default di PpdbSetting).
 */
class PpdbSeeder extends Seeder
{
    public function run(): void
    {
        if (PpdbItem::query()->exists()) {
            return;
        }

        // [section, icon, title, label, text, photo]
        $rows = [
            // ---- Pengertian ----
            ['definisi', null, 'Penerimaan', null, 'Proses seleksi resmi yang diselenggarakan oleh sekolah untuk menjaring calon peserta didik baru setiap tahun ajaran.', null],
            ['definisi', null, 'Peserta', null, 'Lulusan SMP/MTs sederajat yang memenuhi persyaratan dan siap menempuh pendidikan menengah kejuruan.', null],
            ['definisi', null, 'Didik', null, 'Setiap peserta didik dibina menjadi pribadi berkarakter, kompeten, dan siap kerja maupun berwirausaha.', null],
            ['definisi', null, 'Baru', null, 'Generasi baru Skaneda yang siap menorehkan prestasi akademik maupun nonakademik di tingkat kota, provinsi, hingga nasional.', null],

            // ---- Jalur ----
            ['jalur', 'fa-map-marked-alt', 'Zonasi', 'Kuota ± 50%', 'Bagi calon peserta didik yang berdomisili di dalam wilayah zonasi yang ditetapkan pemerintah daerah.', null],
            ['jalur', 'fa-hand-holding-heart', 'Afirmasi', 'Kuota ± 15%', 'Bagi peserta didik dari keluarga ekonomi tidak mampu dan anak penyandang disabilitas.', null],
            ['jalur', 'fa-trophy', 'Prestasi', 'Kuota ± 25%', 'Bagi peserta didik dengan prestasi akademik maupun nonakademik yang diakui pemerintah.', null],
            ['jalur', 'fa-briefcase', 'Perpindahan Tugas', 'Kuota ± 5%', 'Bagi anak dari orang tua/wali yang berpindah tugas, dengan bukti surat penugasan resmi.', null],

            // ---- Persyaratan ----
            ['syarat', 'fa-id-card', 'Kartu Keluarga (KK)', null, 'Fotokopi KK terbaru yang masih berlaku.', null],
            ['syarat', 'fa-calendar-alt', 'Akte Kelahiran', null, 'Fotokopi akta kelahiran calon peserta didik.', null],
            ['syarat', 'fa-file-alt', 'Ijazah / SKL', null, 'Fotokopi ijazah SMP/MTs atau surat keterangan lulus.', null],
            ['syarat', 'fa-user-graduate', 'Rapor Semester 1–5', null, 'Fotokopi rapor untuk jalur prestasi nilai akademik.', null],
            ['syarat', 'fa-image', 'Pas Foto 3×4', null, 'Pas foto berwarna latar merah/biru, sebanyak 3 lembar.', null],
            ['syarat', 'fa-trophy', 'Sertifikat Prestasi', null, 'Untuk jalur prestasi: piagam/sertifikat lomba yang diakui.', null],

            // ---- Alur ----
            ['alur', null, 'Buat Akun', null, 'Daftar akun dan ambil PIN pada portal PPDB resmi.', null],
            ['alur', null, 'Isi Formulir', null, 'Lengkapi data diri, pilih jalur, dan tentukan pilihan sekolah.', null],
            ['alur', null, 'Unggah Berkas', null, 'Upload dokumen persyaratan sesuai jalur yang dipilih.', null],
            ['alur', null, 'Verifikasi', null, 'Panitia memverifikasi dan memeringkatkan calon peserta didik.', null],
            ['alur', null, 'Pengumuman', null, 'Hasil seleksi diumumkan melalui portal dan papan informasi sekolah.', null],
            ['alur', null, 'Daftar Ulang', null, 'Calon yang diterima melakukan daftar ulang sesuai jadwal.', null],

            // ---- Jadwal ----
            ['jadwal', null, 'Pengumuman & sosialisasi PPDB', 'Maret – April 2026', null, null],
            ['jadwal', null, 'Pendaftaran akun & pengambilan PIN', 'Mei 2026', null, null],
            ['jadwal', null, 'Pendaftaran & unggah berkas (semua jalur)', 'Juni 2026', null, null],
            ['jadwal', null, 'Verifikasi & pemeringkatan berkas', 'Juni 2026', null, null],
            ['jadwal', null, 'Pengumuman hasil seleksi', 'Awal Juli 2026', null, null],
            ['jadwal', null, 'Daftar ulang peserta didik diterima', 'Juli 2026', null, null],
            ['jadwal', null, 'Masa Pengenalan Lingkungan Sekolah (MPLS)', 'Juli 2026', null, null],

            // ---- Program keahlian ----
            ['jurusan', null, 'Rekayasa Perangkat Lunak', 'TEKNOLOGI INFORMASI', 'Mempelajari pembuatan aplikasi, pemrograman web & mobile, hingga pengujian dan manajemen proyek perangkat lunak.', 'images/ppdb/rpl.jpg'],
            ['jurusan', null, 'Kuliner', 'PARIWISATA', 'Menguasai seni memasak, pengolahan bahan makanan, tata hidang, hingga manajemen usaha kuliner dan pastry & bakery.', 'images/ppdb/kuliner.jpg'],
            ['jurusan', null, 'Agribisnis Pengolahan Hasil Pertanian', 'AGRIBISNIS & AGROTEKNOLOGI', 'Mengolah hasil pertanian & perikanan menjadi produk bernilai tambah: roti, samosa, es krim, dan aneka produk wirausaha.', 'images/ppdb/aphp.jpg'],
            ['jurusan', null, 'Desain Komunikasi Visual', 'SENI & EKONOMI KREATIF', 'Mengasah kreativitas desain grafis, ilustrasi, fotografi, videografi, dan branding untuk industri kreatif.', 'images/ppdb/dkv.jpg'],
            ['jurusan', null, 'Layanan Perbankan Syariah', 'BISNIS & MANAJEMEN', 'Mendalami operasional lembaga keuangan syariah, layanan perbankan, administrasi transaksi, dan literasi keuangan.', 'images/ppdb/lps.jpg'],
            ['jurusan', null, 'Skaneda, Satu Keluarga', 'KARAKTER & BUDAYA', 'Lingkungan kondusif, fasilitas lengkap, pengajar profesional, dan kemitraan luas bersama dunia usaha & industri.', 'images/smkn-guru.jpg'],

            // ---- FAQ ----
            ['faq', null, 'Kapan PPDB SMK Negeri 2 Mojokerto dibuka?', null, 'Pendaftaran biasanya dibuka pada bulan Mei–Juni setiap tahun ajaran baru. Jadwal resmi mengikuti ketetapan Dinas Pendidikan Provinsi Jawa Timur dan diumumkan melalui website serta media sosial sekolah.', null],
            ['faq', null, 'Apakah pendaftaran dilakukan secara online?', null, 'Ya. Pendaftaran dilakukan melalui portal PPDB resmi secara daring (online). Calon peserta didik membuat akun, mengambil PIN, mengisi formulir, dan mengunggah berkas persyaratan pada portal tersebut.', null],
            ['faq', null, 'Berapa kuota daya tampung SMK Negeri 2 Mojokerto?', null, 'Daya tampung disesuaikan dengan ketetapan resmi setiap tahun ajaran. Informasi kuota per kompetensi keahlian diumumkan panitia PPDB pada saat sosialisasi. Pantau terus pengumuman sekolah.', null],
            ['faq', null, 'Bagaimana cara memilih jalur yang tepat?', null, 'Sesuaikan dengan kondisi kamu: domisili (zonasi), kondisi ekonomi atau disabilitas (afirmasi), prestasi akademik/nonakademik (prestasi), atau perpindahan tugas orang tua. Konsultasikan dengan guru BK di sekolah asal.', null],
            ['faq', null, 'Apakah ada biaya pendaftaran?', null, 'Tidak ada. Pendaftaran PPDB di sekolah negeri GRATIS. Waspadai oknum yang meminta biaya pendaftaran dengan dalih apa pun dan laporkan ke panitia resmi sekolah.', null],
        ];

        $order = [];
        foreach ($rows as [$section, $icon, $title, $label, $text, $photo]) {
            $order[$section] = ($order[$section] ?? -1) + 1;

            PpdbItem::create([
                'section'   => $section,
                'icon'      => $icon,
                'title'     => $title,
                'label'     => $label,
                'text'      => $text,
                'photo'     => $photo,
                'order'     => $order[$section],
                'is_active' => true,
            ]);
        }
    }
}
