<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiSetting extends Model
{
    protected $table = 'visi_misi_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Teks bawaan (sama dengan isi halaman sebelum ada admin).
     * Dipakai selama key belum pernah disimpan dari admin.
     */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_kicker'  => 'Arah & langkah kami',
            'hero_title_1' => 'VISI &',
            'hero_title_2' => 'MISI SKANEDA',
            'hero_lead'    => 'Landasan dan arah SMK Negeri 2 Mojokerto dalam menghasilkan sumber daya manusia yang berkarakter, kompeten, siap kerja, mampu berwirausaha, dan mampu bersaing di era globalisasi.',
            'hero_pill_1'  => 'Visi & Misi',
            'hero_pill_2'  => 'Tujuan Sekolah',
            'hero_pill_3'  => 'Nilai-nilai',

            // ---- VISI ----
            'visi_statement' => 'Menghasilkan Sumber Daya Manusia (SDM) yang *berkarakter, kompeten, siap kerja,* serta mampu *berwirausaha dan bersaing di era globalisasi.*',
            'visi_tags'      => "Berkarakter\nKompeten\nSiap Kerja\nBerwirausaha",

            // ---- MISI ----
            'misi_eyebrow'      => 'Langkah kami',
            'misi_heading'      => 'Misi',
            'misi_heading_gold' => 'Sekolah',
            'misi_desc'         => 'Tiga langkah utama yang menjadi dasar SMK Negeri 2 Mojokerto dalam meningkatkan mutu pendidikan dan menyiapkan lulusan yang profesional.',

            // ---- TUJUAN ----
            'tujuan_eyebrow'      => 'Yang ingin kami capai',
            'tujuan_heading'      => 'Tujuan',
            'tujuan_heading_gold' => 'Sekolah',

            // ---- NILAI ----
            'nilai_eyebrow'      => 'Budaya sekolah',
            'nilai_heading'      => 'Nilai-nilai',
            'nilai_heading_gold' => 'Utama',
            'nilai_desc'         => 'Nilai-nilai yang menjadi budaya kerja seluruh warga sekolah.',

            // ---- CTA ----
            'cta_title'       => 'Bergabunglah bersama',
            'cta_title_gold'  => 'SKANEDA!',
            'cta_text'        => 'Wujudkan masa depanmu bersama SMK Negeri 2 Mojokerto — sekolah vokasi unggulan yang siap membentuk generasi beriman, berkarakter, dan berdaya saing global.',
            'cta_button_text' => 'Info PPDB 2026/2027',
            'cta_button_url'  => '',   // kosong = otomatis ke beranda #ppdb
        ];
    }

    /** Semua nilai: default digabung dengan yang tersimpan di database. */
    public static function allValues(): array
    {
        $values = static::defaults();

        foreach (static::query()->pluck('value', 'key') as $key => $value) {
            if (array_key_exists($key, $values)) {
                $values[$key] = (string) $value;
            }
        }

        return $values;
    }

    public static function putMany(array $data): void
    {
        $allowed = array_keys(static::defaults());

        foreach ($data as $key => $value) {
            if (in_array($key, $allowed, true)) {
                static::updateOrCreate(['key' => $key], ['value' => (string) $value]);
            }
        }
    }
}
