<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Dua halaman pengaturan berbasis key–value:
 *   - Informasi Footer      (admin.footer.*)
 *   - Konten Umum Website   (admin.general.*)
 */
class SiteSettingController extends Controller
{
    private const FOOTER_KEYS = [
        'footer_sub', 'footer_tagline', 'footer_social_label',
        'footer_instagram', 'footer_youtube', 'footer_facebook',
        'footer_partners_label', 'footer_copyright', 'footer_slogan',
    ];

    private const GENERAL_KEYS = [
        'hero_eyebrow', 'hero_desc',
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

    // ===================== KONTEN UMUM WEBSITE =====================
    public function general(): View
    {
        $settings = SiteSetting::many(self::GENERAL_KEYS);

        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_eyebrow'    => ['nullable', 'string', 'max:255'],
            'hero_desc'       => ['nullable', 'string', 'max:500'],
            'contact_sub'     => ['nullable', 'string', 'max:255'],
            'contact_line'    => ['nullable', 'string', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:500'],
            'contact_phone'   => ['nullable', 'string', 'max:50'],
            'contact_email'   => ['nullable', 'email', 'max:255'],
            'contact_hours'   => ['nullable', 'string', 'max:255'],
        ]);

        SiteSetting::setMany($this->collect($request, self::GENERAL_KEYS));

        return redirect()
            ->route('admin.general.index')
            ->with('status', 'Konten Umum Website berhasil disimpan.');
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
