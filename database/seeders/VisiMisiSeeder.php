<?php

namespace Database\Seeders;

use App\Models\VisiMisiItem;
use Illuminate\Database\Seeder;

/**
 * Mengisi Misi, Tujuan, dan Nilai-nilai dengan konten yang sebelumnya
 * hardcoded di halaman Visi & Misi. Hanya berjalan kalau tabel masih kosong,
 * jadi aman diulang dan tidak menimpa hasil edit admin.
 *
 * Teks tunggal (hero, visi, CTA) tidak perlu di-seed — sudah ada nilai bawaan
 * di App\Models\VisiMisiSetting::defaults().
 */
class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        if (VisiMisiItem::query()->exists()) {
            return;
        }

        $data = [
            'misi' => [
                ['fa-book-open', 'Pendidikan Berorientasi Mutu', 'Mengembangkan sistem pendidikan yang berorientasi pada mutu, dengan tetap berakar pada norma dan nilai budaya bangsa Indonesia.'],
                ['fa-handshake', 'Sinergi dengan Dunia Usaha & Industri', 'Meningkatkan layanan prima dan membangun sinergi dengan masyarakat serta dunia usaha dan industri untuk memenuhi kebutuhan tenaga kerja secara profesional.'],
                ['fa-user-graduate', 'Lulusan Cerdas & Kompeten', 'Mewujudkan tamatan yang cerdas, kompeten, memiliki etos kerja, dan siap bersaing serta beradaptasi menghadapi tuntutan era globalisasi.'],
            ],
            'tujuan' => [
                [null, 'Lulusan Siap Kerja', 'Menghasilkan lulusan yang kompeten dan terserap di dunia kerja maupun melanjutkan ke jenjang pendidikan tinggi.'],
                [null, 'Layanan Vokasi Berkualitas', 'Memberikan layanan pendidikan vokasi yang bermutu, profesional, dan berorientasi pada kebutuhan industri.'],
                [null, 'Digitalisasi & Sarana Modern', 'Mengembangkan sarana prasarana dan sistem digital sekolah yang mendukung pembelajaran modern.'],
                [null, 'Budaya Prestasi', 'Menumbuhkan budaya berprestasi akademik, non-akademik, dan karya inovasi di kalangan siswa dan guru.'],
            ],
            'nilai' => [
                ['fa-mosque', 'Iman & Takwa', 'Menjadikan nilai keagamaan sebagai pondasi sikap dan perilaku sehari-hari.'],
                ['fa-briefcase', 'Profesionalisme', 'Bekerja dengan dedikasi, disiplin, dan tanggung jawab dalam setiap tugas.'],
                ['fa-lightbulb', 'Kreativitas', 'Berani berpikir baru, berinovasi, dan menghasilkan karya yang bermanfaat.'],
                ['fa-people-group', 'Kolaborasi', 'Membangun sinergi antarsiswa, guru, dan mitra industri untuk hasil terbaik.'],
                ['fa-scale-balanced', 'Integritas', 'Menjunjung kejujuran, konsistensi, dan etika dalam segala tindakan.'],
                ['fa-seedling', 'Kewirausahaan', 'Menanamkan keberanian mengambil peluang dan kemandirian ekonomi.'],
            ],
        ];

        foreach ($data as $type => $rows) {
            foreach ($rows as $i => [$icon, $title, $text]) {
                VisiMisiItem::create([
                    'type'      => $type,
                    'icon'      => $icon,
                    'title'     => $title,
                    'text'      => $text,
                    'order'     => $i,
                    'is_active' => true,
                ]);
            }
        }
    }
}
