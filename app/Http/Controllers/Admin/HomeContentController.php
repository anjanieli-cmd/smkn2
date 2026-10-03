<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAchievement;
use App\Models\HomeIndustryLogo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Bagian beranda berbentuk daftar (repeater), diatur dari halaman Konten Beranda:
 *   - Kerja Sama Industri (logo)
 *   - Prestasi Sekolah (kartu feed)
 * Halaman tampilnya ada di SiteSettingController@general (tab-tab di sana).
 */
class HomeContentController extends Controller
{
    /** Upload langsung ke public/, sama seperti modul Guru & Staf. */
    private const INDUSTRY_DIR    = 'images/industri';
    private const ACHIEVEMENT_DIR = 'images/prestasi';

    /** Hanya file hasil upload lewat admin yang boleh dihapus otomatis (gambar bawaan aman). */
    private const UPLOAD_PREFIX = 'upload_';

    // ===================== KERJA SAMA INDUSTRI =====================
    public function updateIndustry(Request $request): RedirectResponse
    {
        $request->validate([
            'items'                 => ['nullable', 'array'],
            'items.*.name'          => ['nullable', 'string', 'max:255'],
            'items.*.is_active'     => ['nullable', 'boolean'],
            'items.*.logo'          => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'],
            'items.*.existing_logo' => ['nullable', 'string', 'max:255'],
        ]);

        $old = HomeIndustryLogo::pluck('logo')->all();

        DB::transaction(function () use ($request) {
            HomeIndustryLogo::query()->delete();

            $order = 0;
            foreach ($request->input('items', []) as $i => $row) {
                $path = $row['existing_logo'] ?? null;
                if ($request->hasFile("items.$i.logo")) {
                    $path = $this->storeFile($request->file("items.$i.logo"), self::INDUSTRY_DIR);
                }
                if (blank($path)) {
                    continue; // tanpa logo tidak ada yang bisa ditampilkan
                }

                HomeIndustryLogo::create([
                    'name'      => filled($row['name'] ?? null) ? trim($row['name']) : 'Mitra Industri',
                    'logo'      => $path,
                    'is_active' => (bool) ($row['is_active'] ?? false),
                    'order'     => $order++,
                ]);
            }
        });

        $this->cleanup($old, HomeIndustryLogo::pluck('logo')->all());

        return $this->back('industri', 'Kerja Sama Industri berhasil disimpan.');
    }

    // ===================== PRESTASI SEKOLAH =====================
    public function updateAchievements(Request $request): RedirectResponse
    {
        $request->validate([
            'cards'                  => ['nullable', 'array'],
            'cards.*.tag'            => ['nullable', 'string', 'max:255'],
            'cards.*.title'          => ['nullable', 'string', 'max:255'],
            'cards.*.subtitle'       => ['nullable', 'string', 'max:255'],
            'cards.*.description'    => ['nullable', 'string', 'max:1000'],
            'cards.*.year'           => ['nullable', 'string', 'max:20'],
            'cards.*.meta_label'     => ['nullable', 'string', 'max:100'],
            'cards.*.is_active'      => ['nullable', 'boolean'],
            'cards.*.image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'cards.*.existing_image' => ['nullable', 'string', 'max:255'],
        ]);

        $old = HomeAchievement::pluck('image')->all();

        DB::transaction(function () use ($request) {
            HomeAchievement::query()->delete();

            $order = 0;
            foreach ($request->input('cards', []) as $i => $row) {
                if (blank($row['title'] ?? null)) {
                    continue; // kartu tanpa judul dilewati
                }

                $path = $row['existing_image'] ?? null;
                if ($request->hasFile("cards.$i.image")) {
                    $path = $this->storeFile($request->file("cards.$i.image"), self::ACHIEVEMENT_DIR);
                }

                HomeAchievement::create([
                    'image'       => filled($path) ? $path : null,
                    'tag'         => $this->nullIfBlank($row['tag'] ?? null),
                    'title'       => trim($row['title']),
                    'subtitle'    => $this->nullIfBlank($row['subtitle'] ?? null),
                    'description' => $this->nullIfBlank($row['description'] ?? null),
                    'year'        => $this->nullIfBlank($row['year'] ?? null),
                    'meta_label'  => $this->nullIfBlank($row['meta_label'] ?? null),
                    'is_active'   => (bool) ($row['is_active'] ?? false),
                    'order'       => $order++,
                ]);
            }
        });

        $this->cleanup($old, HomeAchievement::pluck('image')->all());

        return $this->back('prestasi', 'Prestasi Sekolah berhasil disimpan.');
    }

    // ===================== HELPER =====================
    private function back(string $tab, string $message): RedirectResponse
    {
        return redirect()
            ->to(route('admin.general.index') . '#' . $tab)
            ->with('status', $message);
    }

    private function nullIfBlank(?string $value): ?string
    {
        return filled($value) ? trim($value) : null;
    }

    private function storeFile($file, string $dir): string
    {
        $full = public_path($dir);
        if (!file_exists($full)) {
            mkdir($full, 0755, true);
        }

        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $filename = self::UPLOAD_PREFIX . time() . '_' . $safeName;
        $file->move($full, $filename);

        return $dir . '/' . $filename;
    }

    /** Hapus file hasil upload yang sudah tidak dipakai (gambar bawaan tidak pernah dihapus). */
    private function cleanup(array $oldPaths, array $keptPaths): void
    {
        foreach ($oldPaths as $path) {
            if ($path && !in_array($path, $keptPaths, true) && str_starts_with(basename($path), self::UPLOAD_PREFIX)) {
                $full = public_path($path);
                if (is_file($full)) {
                    @unlink($full);
                }
            }
        }
    }
}
