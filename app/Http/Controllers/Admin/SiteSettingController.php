<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Dua halaman pengaturan berbasis key–value:
 *   - Informasi Footer   (admin.footer.*)
 *   - Konten Beranda     (admin.general.*)  -> tab Hero, Sambutan Kepala Sekolah, Kontak
 */
class SiteSettingController extends Controller
{
    /** Folder upload foto (langsung di public/, sama seperti modul Guru & Staf). */
    private const PHOTO_DIR = 'images/sambutan';

    /** Hanya file hasil upload lewat admin yang boleh dihapus otomatis (foto bawaan aman). */
    private const UPLOAD_PREFIX = 'upload_';

    private const FOOTER_KEYS = [
        'footer_sub', 'footer_tagline', 'footer_social_label',
        'footer_instagram', 'footer_youtube', 'footer_facebook', 'footer_tiktok',
        'footer_partners_label', 'footer_copyright', 'footer_slogan',
    ];

    /** Foto sambutan (sambutan_photo) ditangani terpisah karena berupa file upload. */
    private const GENERAL_KEYS = [
        'hero_eyebrow', 'hero_desc',
        'sambutan_name', 'sambutan_role', 'sambutan_quote', 'sambutan_message',
        'contact_sub', 'contact_line',
        'contact_address', 'contact_phone', 'contact_email', 'contact_hours',
    ];

    // ===================== INFORMASI FOOTER =====================
    public function footer(): View
    {
        $settings = SiteSetting::many(self::FOOTER_KEYS);

        return view('admin.settings.footer', compact('settings'));
    }

    public function updateFooter(Request $request): RedirectResponse
    {
        $request->validate([
            'footer_sub'            => ['nullable', 'string', 'max:255'],
            'footer_tagline'        => ['nullable', 'string', 'max:500'],
            'footer_social_label'   => ['nullable', 'string', 'max:100'],
            'footer_instagram'      => ['nullable', 'url', 'max:255'],
            'footer_youtube'        => ['nullable', 'url', 'max:255'],
            'footer_facebook'       => ['nullable', 'url', 'max:255'],
            'footer_tiktok'         => ['nullable', 'url', 'max:255'],
            'footer_partners_label' => ['nullable', 'string', 'max:100'],
            'footer_copyright'      => ['nullable', 'string', 'max:255'],
            'footer_slogan'         => ['nullable', 'string', 'max:255'],
        ], [
            'url' => 'Link :attribute harus berupa URL lengkap (diawali https://).',
        ]);

        SiteSetting::setMany($this->collect($request, self::FOOTER_KEYS));

        return redirect()
            ->route('admin.footer.index')
            ->with('status', 'Informasi Footer berhasil disimpan.');
    }

    // ===================== KONTEN BERANDA =====================
    public function general(): View
    {
        $settings = SiteSetting::many(array_merge(self::GENERAL_KEYS, ['sambutan_photo']));

        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_eyebrow'     => ['nullable', 'string', 'max:255'],
            'hero_desc'        => ['nullable', 'string', 'max:500'],

            'sambutan_photo'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'sambutan_name'    => ['nullable', 'string', 'max:255'],
            'sambutan_role'    => ['nullable', 'string', 'max:255'],
            'sambutan_quote'   => ['nullable', 'string', 'max:500'],
            'sambutan_message' => ['nullable', 'string', 'max:3000'],

            'contact_sub'      => ['nullable', 'string', 'max:255'],
            'contact_line'     => ['nullable', 'string', 'max:255'],
            'contact_address'  => ['nullable', 'string', 'max:500'],
            'contact_phone'    => ['nullable', 'string', 'max:50'],
            'contact_email'    => ['nullable', 'email', 'max:255'],
            'contact_hours'    => ['nullable', 'string', 'max:255'],
        ]);

        $data = $this->collect($request, self::GENERAL_KEYS);

        // Foto kepala sekolah: hanya diganti kalau ada file baru yang diupload
        if ($request->hasFile('sambutan_photo')) {
            $old = SiteSetting::get('sambutan_photo');

            $data['sambutan_photo'] = $this->storePhoto($request->file('sambutan_photo'));

            if ($old && str_starts_with(basename($old), self::UPLOAD_PREFIX)) {
                $full = public_path($old);
                if (is_file($full)) {
                    @unlink($full);
                }
            }
        }

        SiteSetting::setMany($data);

        return redirect()
            ->route('admin.general.index')
            ->with('status', 'Konten Beranda berhasil disimpan.');
    }

    private function storePhoto($file): string
    {
        $dir = public_path(self::PHOTO_DIR);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $filename = self::UPLOAD_PREFIX . time() . '_' . $safeName;
        $file->move($dir, $filename);

        return self::PHOTO_DIR . '/' . $filename;
    }

    private function collect(Request $request, array $keys): array
    {
        $out = [];
        foreach ($keys as $key) {
            $out[$key] = trim((string) $request->input($key, ''));
        }

        return $out;
    }
}
