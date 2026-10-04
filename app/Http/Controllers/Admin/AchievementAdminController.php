<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolAchievement;
use App\Models\SiteSetting;
use App\Support\PrestasiContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AchievementAdminController extends Controller
{
    /** Foto hasil upload admin disimpan di sini. Hanya file berawalan upload_ yang boleh dihapus otomatis. */
    private const PHOTO_DIR = 'images/prestasi';
    private const UPLOAD_PREFIX = 'upload_';

    private const LEVELS = ['Kota/Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];

    // ===================== DAFTAR PRESTASI + TEKS HALAMAN =====================
    public function index(Request $request): View
    {
        $query = SchoolAchievement::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('winner_name', 'like', "%{$search}%")
                  ->orWhere('tag', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->input('level'));
        }

        $items   = $query->ordered()->get();
        $content = PrestasiContent::all();
        $tab     = $request->input('tab') === 'teks' ? 'teks' : 'daftar';

        return view('admin.achievements.index', compact('items', 'content', 'tab'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image_url'] = $this->uploadPhoto($request->file('image'));
        }

        $achievement = SchoolAchievement::create($data);
        $this->keepSingleFeatured($achievement);

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Prestasi baru "' . $achievement->title . '" berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $achievement = SchoolAchievement::findOrFail($id);
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deleteUploadedPhoto($achievement->image_url);
            $data['image_url'] = $this->uploadPhoto($request->file('image'));
        }

        $achievement->update($data);
        $this->keepSingleFeatured($achievement);

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Data prestasi "' . $achievement->title . '" berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $achievement = SchoolAchievement::findOrFail($id);
        $title = $achievement->title;

        $this->deleteUploadedPhoto($achievement->image_url);
        $achievement->delete();

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Data prestasi "' . $title . '" berhasil dihapus. (Untuk memulihkan data bawaan: php artisan db:seed --class=AchievementSeeder)');
    }

    // ===================== TEKS HALAMAN PUBLIK =====================
    public function updatePage(Request $request): RedirectResponse
    {
        $rules = [];
        foreach (PrestasiContent::keys() as $key) {
            if (in_array($key, PrestasiContent::IMAGE_KEYS, true)) {
                $rules[$key] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'];
            } else {
                $rules[$key] = ['nullable', 'string', 'max:1500'];
            }
        }
        $request->validate($rules);

        $data = [];
        foreach (PrestasiContent::keys() as $key) {
            if (in_array($key, PrestasiContent::IMAGE_KEYS, true)) {
                continue;
            }
            $data[PrestasiContent::PREFIX . $key] = trim((string) $request->input($key, ''));
        }

        // Foto (momen kejayaan & latar kutipan): hanya diganti kalau ada file baru.
        foreach (PrestasiContent::IMAGE_KEYS as $key) {
            if ($request->hasFile($key)) {
                $this->deleteUploadedPhoto(PrestasiContent::get($key));
                $data[PrestasiContent::PREFIX . $key] = $this->uploadPhoto($request->file($key));
            }
        }

        SiteSetting::setMany($data);

        return redirect()
            ->route('admin.achievements.index', ['tab' => 'teks'])
            ->with('success', 'Teks halaman Prestasi berhasil disimpan.');
    }

    /** Kembalikan semua teks halaman ke bawaan (data prestasi tidak disentuh). */
    public function resetPage(): RedirectResponse
    {
        SiteSetting::where('key', 'like', PrestasiContent::PREFIX . '%')->delete();

        return redirect()
            ->route('admin.achievements.index', ['tab' => 'teks'])
            ->with('success', 'Teks halaman Prestasi dikembalikan ke bawaan.');
    }

    // ===================== HELPER =====================
    private function validated(Request $request): array
    {
        $v = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'level'       => ['required', 'string', 'in:' . implode(',', self::LEVELS)],
            'level_label' => ['nullable', 'string', 'max:255'],
            'year'        => ['required', 'digits:4'],
            'rank'        => ['nullable', 'string', 'max:255'],
            'tag'         => ['nullable', 'string', 'max:255'],
            'event_date'  => ['nullable', 'date'],
            'winner_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        unset($v['image']);

        $v['is_featured'] = $request->boolean('is_featured');
        $v['is_active']   = $request->boolean('is_active');

        return $v;
    }

    /** Hanya satu prestasi yang boleh jadi "Capaian Utama" di halaman publik. */
    private function keepSingleFeatured(SchoolAchievement $achievement): void
    {
        if ($achievement->is_featured) {
            SchoolAchievement::where('id', '!=', $achievement->id)
                ->where('is_featured', true)
                ->update(['is_featured' => false]);
        }
    }

    private function uploadPhoto($file): string
    {
        $dir = public_path(self::PHOTO_DIR);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = self::UPLOAD_PREFIX . time() . '_' . Str::random(4) . '_'
            . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.'
            . strtolower($file->getClientOriginalExtension());

        $file->move($dir, $name);

        return self::PHOTO_DIR . '/' . $name;
    }

    /** Hanya hapus file yang memang diunggah lewat admin (foto bawaan dan foto yang dipakai bersama aman). */
    private function deleteUploadedPhoto(?string $path): void
    {
        if (!$path) {
            return;
        }

        $prefix = self::PHOTO_DIR . '/' . self::UPLOAD_PREFIX;
        if (Str::startsWith($path, $prefix) && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}