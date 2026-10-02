<?php

namespace Database\Seeders;

use App\Models\StrukturMember;
use App\Models\StrukturRole;
use Illuminate\Database\Seeder;

/**
 * Mengisi bagan (14 orang) dan 3 kartu "Alur Kerja" dengan konten yang sebelumnya
 * hardcoded di halaman Struktur Organisasi. Foto memakai file lama di
 * public/images/struktur/ (tidak perlu dipindah). Hanya berjalan kalau tabel
 * masih kosong, jadi aman diulang dan tidak menimpa hasil edit admin.
 *
 * Teks tunggal (hero, judul bagian, CTA) tidak perlu di-seed — sudah ada nilai
 * bawaan di App\Models\StrukturSetting::defaults().
 */
class StrukturSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedMembers();
        $this->seedRoles();
    }

    private function seedMembers(): void
    {
        if (StrukturMember::query()->exists()) {
            return;
        }

        // [level, bidang, jabatan, orang, badge, unit, deskripsi, ikon, foto, [tugas]]
        $rows = [
            [1, 'pimpinan', 'Kepala Sekolah', 'Iswahyudi S.ST. M.Pd.', 'Pimpinan', 'Pimpinan Sekolah', 'Pemimpin tertinggi organisasi sekolah', 'fa-star', 'pimpinan', [
                'Memimpin dan mengarahkan penyelenggaraan pendidikan sekolah.',
                'Menetapkan kebijakan, program kerja, dan target mutu sekolah.',
            ]],
            [2, 'kurikulum', 'Waka Kurikulum', 'MELATI PUSPITA SARI, S.Pd.', null, 'Kurikulum', 'Perencanaan dan pengelolaan bidang kurikulum.', 'fa-book-open', 'melati', [
                'Mengelola dan mengoordinasikan pelaksanaan kurikulum sekolah.',
                'Mengatur program pembelajaran dan administrasi kurikulum.',
            ]],
            [2, 'kesiswaan', 'Waka Kesiswaan', 'AINUR ROFIK, M. Pd, Si.', null, 'Kesiswaan', 'Pembinaan dan layanan peserta didik.', 'fa-users', 'ainur', [
                'Mengoordinasikan pembinaan peserta didik dan kegiatan kesiswaan.',
                'Mendukung pelaksanaan program pengembangan karakter siswa.',
            ]],
            [2, 'sapras', 'Waka Sarana & Prasarana', 'M. WIRA HENDY HIMAWAN, M.Pd', null, 'Sarana & Prasarana', 'Pengelolaan sarana, prasarana, dan fasilitas sekolah.', 'fa-building', 'wira', [
                'Mengoordinasikan pengelolaan sarana dan prasarana sekolah.',
                'Memastikan fasilitas pendukung pembelajaran tersedia dan terawat.',
            ]],
            [2, 'humas', 'Waka Humastri', 'ARIKAWWEKU CKRISNA, S.Pd.', null, 'Humastri', 'Hubungan sekolah dengan masyarakat dan dunia industri.', 'fa-handshake', 'arikawweku', [
                'Mengoordinasikan hubungan sekolah dengan masyarakat dan dunia industri.',
                'Mengembangkan kerja sama dan kemitraan sekolah.',
            ]],
            [3, 'keuangan', 'Bendahara BOS', 'MEGA NOVINDA SARI, S.Pd.', null, 'Keuangan', 'Pengelolaan administrasi dan keuangan BOS sekolah.', 'fa-money-bill-wave', 'mega', [
                'Mengelola administrasi dan pertanggungjawaban dana BOS.',
                'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
            ]],
            [3, 'keuangan', 'Bendahara BPOPP', 'FAJAR DHILAMAYA, S.Pd.', null, 'Keuangan', 'Pengelolaan administrasi dan keuangan BPOPP.', 'fa-wallet', 'fajar', [
                'Mengelola administrasi dan pertanggungjawaban dana BPOPP.',
                'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
            ]],
            [3, 'keahlian', 'Ketua Kompetensi Keahlian RPL', 'DANANG TEGUH SANTOSO, S.Kom', null, 'Kompetensi Keahlian RPL', 'Koordinasi pembelajaran dan pengembangan kompetensi RPL.', 'fa-code', 'danang', [
                'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian RPL.',
                'Mengembangkan kompetensi siswa sesuai kebutuhan bidang perangkat lunak.',
            ]],
            [3, 'keahlian', 'Ketua Kompetensi Keahlian APHP', 'DESY ANDINI DILIAWATI, S.T.P.', null, 'Kompetensi Keahlian APHP', 'Koordinasi pembelajaran dan pengembangan kompetensi APHP.', 'fa-seedling', 'desy', [
                'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian APHP.',
                'Mengembangkan kompetensi siswa dalam pengolahan hasil pertanian.',
            ]],
            [3, 'keahlian', 'Ketua Kompetensi Keahlian DKV', 'NURFALAH SEPTAYOGA S.Kom.', null, 'Kompetensi Keahlian DKV', 'Koordinasi pembelajaran dan pengembangan kompetensi DKV.', 'fa-palette', 'nurfalah', [
                'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian DKV.',
                'Mengembangkan kompetensi siswa dalam bidang desain komunikasi visual.',
            ]],
            [3, 'keahlian', 'Ketua Kompetensi Keahlian LPS', 'METIY ARIANA, S.Pd, M.Pd.', null, 'Kompetensi Keahlian LPS', 'Koordinasi pembelajaran dan pengembangan kompetensi LPS.', 'fa-landmark', 'metiy', [
                'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian LPS.',
                'Mengembangkan kompetensi siswa dalam layanan perbankan syariah.',
            ]],
            [3, 'keahlian', 'Ketua Kompetensi Keahlian Kuliner', 'DHIYAH AMANATI KARTIKA SARI, S.Pd.', null, 'Kompetensi Keahlian Kuliner', 'Koordinasi pembelajaran dan pengembangan kompetensi kuliner.', 'fa-utensils', 'dhiyah', [
                'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian Kuliner.',
                'Mengembangkan kompetensi siswa dalam bidang kuliner dan tata boga.',
            ]],
            [3, 'humas', 'Koordinator BKK', 'MULAT ADITYAWIRANTI, S.Pd.', null, 'BKK / Humastri', 'Koordinasi layanan BKK dan penyaluran lulusan.', 'fa-briefcase', 'mulat', [
                'Mengoordinasikan layanan Bursa Kerja Khusus (BKK).',
                'Mendukung penyaluran lulusan dan hubungan dengan dunia kerja.',
            ]],
        ];

        $order = [];
        foreach ($rows as [$level, $bidang, $position, $person, $badge, $unit, $desc, $icon, $photo, $tasks]) {
            $order[$level] = ($order[$level] ?? -1) + 1;

            StrukturMember::create([
                'level'       => $level,
                'bidang'      => $bidang,
                'position'    => $position,
                'person'      => $person,
                'badge'       => $badge,
                'unit'        => $unit,
                'description' => $desc,
                'icon'        => $icon,
                'photo'       => "images/struktur/{$photo}.png", // file lama di public/
                'tasks'       => implode("\n", $tasks),
                'note'        => null,
                'order'       => $order[$level],
                'is_active'   => true,
            ]);
        }
    }

    private function seedRoles(): void
    {
        if (StrukturRole::query()->exists()) {
            return;
        }

        $rows = [
            ['fa-flag-checkered', 'Pimpinan Menetapkan Arah', 'Kepala Sekolah merumuskan kebijakan, program, dan target mutu sekolah, serta memimpin seluruh sumber daya menuju visi “SMK unggul, berkarakter, dan berdaya saing”.'],
            ['fa-diagram-project', 'Wakil Kepala Mengelola', 'Empat wakil kepala sekolah menerjemahkan kebijakan menjadi program kerja nyata di bidang kurikulum, kesiswaan, sarana prasarana, serta humas & industri.'],
            ['fa-graduation-cap', 'KK & GTK Melayani Siswa', 'Kompetensi keahlian, guru, dan tenaga kependidikan berada di garda terdepan: mengajar, membimbing, dan melayani peserta didik setiap hari.'],
        ];

        foreach ($rows as $i => [$icon, $title, $text]) {
            StrukturRole::create(['icon' => $icon, 'title' => $title, 'text' => $text, 'order' => $i, 'is_active' => true]);
        }
    }
}
