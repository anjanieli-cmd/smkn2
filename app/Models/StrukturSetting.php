<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturSetting extends Model
{
    protected $table = 'struktur_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Teks bawaan (sama dengan isi halaman sebelum ada admin).
     * Dipakai selama key belum pernah disimpan dari admin.
     */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_title_1'   => 'STRUKTUR',
            'hero_title_2'   => 'ORGANISASI',
            'hero_vt_title'  => 'Lihat Virtual Tour 360°',
            'hero_vt_sub'    => 'Jelajahi SMK Negeri 2 Mojokerto',

            // ---- BAGAN ----
            'chart_eyebrow'      => 'Bagan Organisasi',
            'chart_heading'      => 'TIGA LAPISAN,',
            'chart_heading_gold' => 'SATU KESATUAN.',

            // ---- VIRTUAL TOUR ----
            'vt_kicker'      => 'Virtual Experience',
            'vt_title'       => 'Jelajahi',
            'vt_title_gold'  => 'SMKN 2 Mojokerto',
            'vt_sub'         => 'Lihat Virtual Tour 360°',
            'vt_desc'        => 'Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.',
            'vt_button_text' => 'Mulai Virtual Tour',
            'vt_button_url'  => '',   // kosong = otomatis ke halaman Virtual Tour

            // ---- ALUR KERJA ----
            'roles_eyebrow'      => 'Alur Kerja Sekolah',
            'roles_heading'      => 'BAGAIMANA',
            'roles_heading_gold' => 'SEKOLAH BEKERJA.',
            'roles_desc'         => 'Setiap bagian memiliki peran yang saling melengkapi — dari perencanaan kebijakan hingga layanan langsung kepada siswa.',

            // ---- CTA PENUTUP ----
            'cta_title'       => 'Ingin mengenal lebih dekat',
            'cta_title_gold'  => 'keluarga besar sekolah?',
            'cta_text'        => 'Kenali para pendidik dan tenaga kependidikan yang membimbing siswa setiap harinya.',
            'cta_button_text' => 'Lihat Guru & Staf',
            'cta_button_url'  => '',   // kosong = otomatis ke route profil.guru-staf
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
