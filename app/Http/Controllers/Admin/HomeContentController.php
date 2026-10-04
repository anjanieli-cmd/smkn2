<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAchievement;
use App\Models\HomeBestAlumni;
use App\Models\HomeIndustryLogo;
use App\Models\HomeMajor;
use App\Models\HomePtn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Bagian beranda berbentuk daftar (repeater), diatur dari halaman Konten Beranda:
 *   - Kerja Sama Industri (logo)
 *   - Prestasi Sekolah (kartu feed)
 *   - Jurusan Unggulan (carousel)
 *   - Lulusan Terbaik (satu lulusan per jurusan)
 *   - Lulusan PTN (perguruan tinggi + nama yang lolos)
 * Halaman tampilnya ada di SiteSettingController@general (tab-tab di sana).
 */
class HomeContentController extends Controller
{
    /** Upload langsung ke public/, sama seperti modul Guru & Staf. */
    private const INDUSTRY_DIR    = 'images/industri';
    private const ACHIEVEMENT_DIR = 'images/prestasi';
    private const MAJOR_DIR       = 'images/jurusan';
    private const ALUMNI_DIR      = 'images/lulusan';
    private const PTN_DIR         = 'images/ptn';

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

    // ===================== JURUSAN UNGGULAN =====================
    public function updateMajors(Request $request): RedirectResponse
    {
        $request->validate([
            'majors'                  => ['nullable', 'array'],
            'majors.*.abbr'           => ['nullable', 'string', 'max:30'],
            'majors.*.full_name'      => ['nullable', 'string', 'max:255'],
            'majors.*.url'            => ['nullable', 'string', 'max:255'],
            'majors.*.color'          => ['nullable', 'regex:/^#?[0-9a-fA-F]{6}$/'],
            'majors.*.is_active'      => ['nullable', 'boolean'],
            'majors.*.image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'majors.*.existing_image' => ['nullable', 'string', 'max:255'],
        ], [
            'majors.*.color.regex' => 'Warna harus berupa kode hex 6 digit, contoh #DB1320.',
        ]);

        $old = HomeMajor::pluck('image')->all();

        DB::transaction(function () use ($request) {
            HomeMajor::query()->delete();

            $order = 0;
            foreach ($request->input('majors', []) as $i => $row) {
                if (blank($row['abbr'] ?? null)) {
                    continue; // tanpa singkatan dilewati
                }

                $path = $row['existing_image'] ?? null;
                if ($request->hasFile("majors.$i.image")) {
                    $path = $this->storeFile($request->file("majors.$i.image"), self::MAJOR_DIR);
                }

                $color = trim((string) ($row['color'] ?? ''));
                if ($color !== '' && !str_starts_with($color, '#')) {
                    $color = '#' . $color;
                }

                HomeMajor::create([
                    'abbr'      => trim($row['abbr']),
                    'full_name' => filled($row['full_name'] ?? null) ? trim($row['full_name']) : trim($row['abbr']),
                    'image'     => filled($path) ? $path : null,
                    'url'       => $this->nullIfBlank($row['url'] ?? null),
                    'color'     => $color !== '' ? $color : null,
                    'is_active' => (bool) ($row['is_active'] ?? false),
                    'order'     => $order++,
                ]);
            }
        });

        $this->cleanup($old, HomeMajor::pluck('image')->all());

        return $this->back('jurusan', 'Jurusan Unggulan berhasil disimpan.');
    }

    // ===================== LULUSAN TERBAIK =====================
    public function updateAlumni(Request $request): RedirectResponse
    {
        $request->validate([
            'alumni'                 => ['nullable', 'array'],
            'alumni.*.major_abbr'    => ['nullable', 'string', 'max:30'],
            'alumni.*.major_name'    => ['nullable', 'string', 'max:255'],
            'alumni.*.name'          => ['nullable', 'string', 'max:255'],
            'alumni.*.year'          => ['nullable', 'string', 'max:20'],
            'alumni.*.code'          => ['nullable', 'string', 'max:50'],
            'alumni.*.is_active'     => ['nullable', 'boolean'],
            'alumni.*.photo'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'alumni.*.existing_photo' => ['nullable', 'string', 'max:255'],
        ]);

        $old = HomeBestAlumni::pluck('photo')->all();

        DB::transaction(function () use ($request) {
            HomeBestAlumni::query()->delete();

            $order = 0;
            foreach ($request->input('alumni', []) as $i => $row) {
                if (blank($row['name'] ?? null)) {
                    continue; // tanpa nama dilewati
                }

                $path = $row['existing_photo'] ?? null;
                if ($request->hasFile("alumni.$i.photo")) {
                    $path = $this->storeFile($request->file("alumni.$i.photo"), self::ALUMNI_DIR);
                }

                $abbr = filled($row['major_abbr'] ?? null) ? trim($row['major_abbr']) : 'ALUMNI';
                $year = filled($row['year'] ?? null) ? trim($row['year']) : '';

                HomeBestAlumni::create([
                    'major_abbr' => $abbr,
                    'major_name' => filled($row['major_name'] ?? null) ? trim($row['major_name']) : $abbr,
                    'name'       => trim($row['name']),
                    'year'       => $year,
                    'code'       => filled($row['code'] ?? null) ? trim($row['code']) : trim($abbr . ($year !== '' ? ' / ' . $year : '')),
                    'photo'      => filled($path) ? $path : null,
                    'is_active'  => (bool) ($row['is_active'] ?? false),
                    'order'      => $order++,
                ]);
            }
        });

        $this->cleanup($old, HomeBestAlumni::pluck('photo')->all());

        return $this->back('alumni', 'Lulusan Terbaik berhasil disimpan.');
    }

    // ===================== LULUSAN PTN =====================
    public function updatePtns(Request $request): RedirectResponse
    {
        $request->validate([
            'ptns'                 => ['nullable', 'array'],
            'ptns.*.name'          => ['nullable', 'string', 'max:255'],
            'ptns.*.students'      => ['nullable', 'string', 'max:5000'],
            'ptns.*.is_active'     => ['nullable', 'boolean'],
            'ptns.*.logo'          => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'],
            'ptns.*.existing_logo' => ['nullable', 'string', 'max:255'],
        ]);

        $old = HomePtn::pluck('logo')->all();

        DB::transaction(function () use ($request) {
            HomePtn::query()->delete();

            $order = 0;
            foreach ($request->input('ptns', []) as $i => $row) {
                if (blank($row['name'] ?? null)) {
                    continue; // tanpa nama PTN dilewati
                }

                $path = $row['existing_logo'] ?? null;
                if ($request->hasFile("ptns.$i.logo")) {
                    $path = $this->storeFile($request->file("ptns.$i.logo"), self::PTN_DIR);
                }

                HomePtn::create([
                    'name'      => trim($row['name']),
                    'logo'      => filled($path) ? $path : null,
                    'students'  => $this->parseStudents((string) ($row['students'] ?? '')),
                    'is_active' => (bool) ($row['is_active'] ?? false),
                    'order'     => $order++,
                ]);
            }
        });

        $this->cleanup($old, HomePtn::pluck('logo')->all());

        return $this->back('ptn', 'Lulusan PTN berhasil disimpan.');
    }

    /**
     * Satu baris = satu siswa, format:  Nama | Program Studi | Kelas | Jalur
     * Hanya nama yang wajib; bagian lain boleh dikosongkan.
     */
    private function parseStudents(string $text): array
    {
        $students = [];
        foreach (preg_split('/\R/', $text) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $parts = array_map('trim', explode('|', $line));
            if (($parts[0] ?? '') === '') {
                continue;
            }
            $students[] = [
                'name'        => $parts[0],
                'program'     => $parts[1] ?? '',
                'class_label' => $parts[2] ?? '',
                'path'        => $parts[3] ?? '',
            ];
        }

        return $students;
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
