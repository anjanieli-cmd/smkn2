<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MajorSeeder extends Seeder
{
    public static function seedIfEmpty(): void
    {
        $majors = [
            [
                'code' => 'RPL',
                'name' => 'Rekayasa Perangkat Lunak',
                'slug' => 'rekayasa-perangkat-lunak',
                'icon_url' => 'images/RPL.png',
                'description' => 'Konsentrasi keahlian pemrograman web, mobile, dan pengembangan software.',
                'is_active' => true,
                'details' => [
                    'hero_subtitle' => 'LOGIKA → CODING → APLIKASI → INDUSTRI TEKNOLOGI → KARIER',
                    'video_url' => 'images/videos/video-rpl.mp4',
                    'kakomli_name' => 'Basukisna Setya Candra, S.Pd.',
                    'kakomli_role' => 'Kepala Program Keahlian RPL',
                    'kakomli_quote' => 'Mencetak generasi developer handal yang siap bersaing di industri teknologi global.',
                    'competencies' => [
                        ['icon' => 'fa-code', 'title' => 'Web Development', 'desc' => 'Pemrograman web modern dengan Laravel, Vue, HTML/CSS, Tailwind.'],
                        ['icon' => 'fa-mobile-screen', 'title' => 'Mobile Apps', 'desc' => 'Pengembangan aplikasi Android & iOS profesional.'],
                        ['icon' => 'fa-database', 'title' => 'Database & Backend API', 'desc' => 'Perancangan basis data relasional & RESTful API.'],
                        ['icon' => 'fa-laptop-code', 'title' => 'Software Engineering', 'desc' => 'Metodologi pengembangan sistem software industri.'],
                    ],
                    'facilities' => [
                        ['title' => 'Laboratorium Komputer RPL 1', 'desc' => 'Spesifikasi PC tinggi untuk coding & desain.', 'image' => 'images/rpl/praktik-rpl.jpg'],
                        ['title' => 'Laboratorium Rekayasa Perangkat Lunak 2', 'desc' => 'Fasilitas server & jaringan internal.', 'image' => 'images/rpl/pengujian-rpl.jpg'],
                    ],
                    'careers' => [
                        ['title' => 'Software Engineer / Web Developer', 'desc' => 'Mengembangkan aplikasi web dan sistem enterprise.'],
                        ['title' => 'Mobile Application Developer', 'desc' => 'Membuat aplikasi Android dan iOS.'],
                        ['title' => 'Database Administrator & QA Tester', 'desc' => 'Pengelolaan basis data dan pengujian kualitas software.'],
                    ],
                ]
            ],
            [
                'code' => 'DKV',
                'name' => 'Desain Komunikasi Visual',
                'slug' => 'desain-komunikasi-visual',
                'icon_url' => 'images/DKV.png',
                'description' => 'Fokus pada grafis, ilustrasi, animasi, videografi, dan desain kreatif.',
                'is_active' => true,
                'details' => [
                    'hero_subtitle' => 'IDE → DESAIN → ANIMASI → VIDEOGRAFI → KREATIF DIGITAL',
                    'video_url' => 'images/videos/video-dkv.mp4',
                    'kakomli_name' => 'Novaria Fajar Kurniawan, S.Sn.',
                    'kakomli_role' => 'Kepala Program Keahlian DKV',
                    'kakomli_quote' => 'Mewujudkan imajinasi visual menjadi karya desain dan media kreatif bernilai tinggi.',
                    'competencies' => [
                        ['icon' => 'fa-palette', 'title' => 'Graphic Design', 'desc' => 'Branding, ilustrasi vector, packaging, dan layout majalah.'],
                        ['icon' => 'fa-film', 'title' => 'Videografi & Editing', 'desc' => 'Pengambilan video, color grading, dan motion graphics.'],
                        ['icon' => 'fa-camera', 'title' => 'Fotografi Studio', 'desc' => 'Teknik tata cahaya, pencahayaan produk, dan foto studio.'],
                    ],
                    'facilities' => [
                        ['title' => 'Studio Foto & Video DKV', 'desc' => 'Peralatan fotografi & videografi standar profesional.', 'image' => 'images/dkv/dkv-photo.jpg'],
                        ['title' => 'Lab Komputer Grafis & Animasi', 'desc' => 'Komputer grafis berspesifikasi tinggi.', 'image' => 'images/dkv/dkv-lab.jpg'],
                    ],
                    'careers' => [
                        ['title' => 'Graphic & UI/UX Designer', 'desc' => 'Merancang identitas visual merek dan antarmuka aplikasi.'],
                        ['title' => 'Videographer & Content Creator', 'desc' => 'Produksi konten video kreatif digital.'],
                    ],
                ]
            ],
            [
                'code' => 'APHP',
                'name' => 'Agribisnis Pengolahan Hasil Pertanian',
                'slug' => 'agribisnis-pengolahan-hasil-pertanian',
                'icon_url' => 'images/APHP.png',
                'description' => 'Inovasi pengolahan hasil pertanian dan pangan modern.',
                'is_active' => true,
                'details' => [
                    'hero_subtitle' => 'BAHAN PANGAN → INOVASI OLAHAN → KONTROL KUALITAS → WIRAUSAHA',
                    'video_url' => 'images/videos/video-aphp.mp4',
                    'kakomli_name' => 'Liawanti Gestika Ardiyana, S.Pi.',
                    'kakomli_role' => 'Kepala Program Keahlian APHP',
                    'kakomli_quote' => 'Mengembangkan keahlian olahan pangan sehat, higienis, dan bernilai ekonomis tinggi.',
                    'competencies' => [
                        ['icon' => 'fa-wheat-awn', 'title' => 'Teknologi Pengolahan Pangan', 'desc' => 'Teknik pengolahan hasil nabati & hewani.'],
                        ['icon' => 'fa-flask', 'title' => 'Pengujian Mutu Pangan', 'desc' => 'Analisis laboratorium dan standar keamanan pangan (HACCP).'],
                    ],
                    'facilities' => [
                        ['title' => 'Lab Pengolahan Hasil Pertanian', 'desc' => 'Peralatan produksi olahan makanan & minuman modern.', 'image' => 'images/aphp/praktik-produksi.jpeg'],
                    ],
                    'careers' => [
                        ['title' => 'Quality Control Pangan', 'desc' => 'Pengawasan kualitas dan keamanan industri pangan.'],
                        ['title' => 'Wirausahawan Bidang Pangan (Foodpreneur)', 'desc' => 'Mengembangkan usaha produk makanan olahan mandiri.'],
                    ],
                ]
            ],
            [
                'code' => 'KULINER',
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'icon_url' => 'images/Kuliner.png',
                'description' => 'Seni tata boga, manajemen kuliner, dan tata hidang profesional.',
                'is_active' => true,
                'details' => [
                    'hero_subtitle' => 'BAHAN BOGA → RESEP NIKMAT → TATA HIDANG → MANAJEMEN RESTO',
                    'video_url' => 'images/videos/video-kuliner.mp4',
                    'kakomli_name' => 'Dra. Lugiati',
                    'kakomli_role' => 'Kepala Program Keahlian Kuliner',
                    'kakomli_quote' => 'Mencetak Chef profesional dan pengusaha kuliner handal kelas internasional.',
                    'competencies' => [
                        ['icon' => 'fa-utensils', 'title' => 'Tata Boga & Pastry', 'desc' => 'Pembuatan masakan Nusantara, Oriental, Continental, & Bakery.'],
                        ['icon' => 'fa-concierge-bell', 'title' => 'Resto & Service Management', 'desc' => 'Tata hidang, pelayanan restoran, dan manajemen katering.'],
                    ],
                    'facilities' => [
                        ['title' => 'Dapur Praktek Kuliner Standar Hotel', 'desc' => 'Dapur dapur stainless steel standar industri perhotelan.', 'image' => 'images/kuliner/kuliner-dapur.jpeg'],
                    ],
                    'careers' => [
                        ['title' => 'Chef / Pastry Chef', 'desc' => 'Juru masak profesional di hotel, restoran, & kapal pesiar.'],
                        ['title' => 'Restaurant Manager / Food Blogger', 'desc' => 'Pengelolaan usaha kuliner & reviewer kuliner.'],
                    ],
                ]
            ],
            [
                'code' => 'LPS',
                'name' => 'Layanan Perbankan Syariah',
                'slug' => 'layanan-perbankan-syariah',
                'icon_url' => 'images/LPS.png',
                'description' => 'Manajemen keuangan syariah dan administrasi perbankan.',
                'is_active' => true,
                'details' => [
                    'hero_subtitle' => 'KEUANGAN SYARIAH → AKUNTANSI → BANK MINI → ADMINISTRASI',
                    'video_url' => 'images/videos/video-lps.mp4',
                    'kakomli_name' => 'Arikaweku Ckrisna, S.Pd., M.Pd.',
                    'kakomli_role' => 'Kepala Program Keahlian LPS',
                    'kakomli_quote' => 'Membentuk tenaga profesional jasa keuangan syariah yang amanah dan kompeten.',
                    'competencies' => [
                        ['icon' => 'fa-calculator', 'title' => 'Akuntansi & Keuangan Syariah', 'desc' => 'Pencatatan keuangan, akad syariah, & transaksi perbankan.'],
                        ['icon' => 'fa-hand-holding-dollar', 'title' => 'Layanan Bank & Customer Service', 'desc' => 'Pelayanan nasabah, teller, dan administrasi perkantoran.'],
                    ],
                    'facilities' => [
                        ['title' => 'Bank Mini Syariah Skaneda', 'desc' => 'Laboratorium transaksi keuangan & perbankan riil.', 'image' => 'images/lps/praktik-rutin.png'],
                    ],
                    'careers' => [
                        ['title' => 'Teller & Customer Service Bank', 'desc' => 'Staf pelayanan nasabah lembaga keuangan syariah.'],
                        ['title' => 'Staf Akuntansi & Keuangan Enterprise', 'desc' => 'Pengelolaan pembukuan keuangan perusahaan.'],
                    ],
                ]
            ],
        ];

        foreach ($majors as $data) {
            $existing = Major::where('code', $data['code'])->first();
            if (!$existing) {
                Major::create($data);
            } else {
                $update = [];
                if (empty($existing->icon_url) || str_starts_with($existing->icon_url, 'fas ')) {
                    $update['icon_url'] = $data['icon_url'];
                }
                if (empty($existing->details)) {
                    $update['details'] = $data['details'];
                }
                if (!empty($update)) {
                    $existing->update($update);
                }
            }
        }
    }

    public function run(): void
    {
        self::seedIfEmpty();
    }
}
