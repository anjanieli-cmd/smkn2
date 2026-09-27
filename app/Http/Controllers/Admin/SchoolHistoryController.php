<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SchoolHistoryController extends Controller
{
    /**
     * Karena ini halaman singleton (satu baris konten untuk seluruh halaman
     * Sejarah Sekolah), "index" langsung menampilkan form edit lengkap
     * dengan semua tab dan repeater — tidak ada halaman index/list.
     */
    public function index(): View
    {
        $history = SchoolHistory::singleton()->load('chapters', 'principals', 'galleries');

        return view('admin.school-history.index', compact('history'));
    }

    public function update(Request $request): RedirectResponse
    {
        $history = SchoolHistory::singleton();

        $data = $request->validate([
            // Hero
            'hero_kicker'      => ['nullable', 'string', 'max:255'],
            'hero_image'       => ['nullable', 'image', 'max:4096'],

            // Intro
            'intro_eyebrow'    => ['nullable', 'string', 'max:255'],
            'intro_title'      => ['nullable', 'string', 'max:255'],
            'intro_desc'       => ['nullable', 'string'],
            'stat1_value'      => ['nullable', 'string', 'max:50'],
            'stat1_label'      => ['nullable', 'string', 'max:100'],
            'stat2_value'      => ['nullable', 'string', 'max:50'],
            'stat2_label'      => ['nullable', 'string', 'max:100'],
            'stat3_value'      => ['nullable', 'string', 'max:50'],
            'stat3_label'      => ['nullable', 'string', 'max:100'],
            'stat4_value'      => ['nullable', 'string', 'max:50'],
            'stat4_label'      => ['nullable', 'string', 'max:100'],

            // Story band
            'story_eyebrow'    => ['nullable', 'string', 'max:255'],
            'story_title'      => ['nullable', 'string', 'max:255'],
            'story_desc'       => ['nullable', 'string'],
            'story_image'      => ['nullable', 'image', 'max:4096'],
            'story_chips'      => ['nullable', 'array'],
            'story_chips.*'    => ['nullable', 'string', 'max:60'],

            // Virtual tour
            'vt_title'         => ['nullable', 'string', 'max:255'],
            'vt_desc'          => ['nullable', 'string'],
            'vt_link'          => ['nullable', 'string', 'max:255'],
            'vt_image'         => ['nullable', 'image', 'max:4096'],

            // Repeater: bab sejarah
            'chapters'                 => ['nullable', 'array'],
            'chapters.*.kicker'        => ['nullable', 'string', 'max:100'],
            'chapters.*.year_label'    => ['nullable', 'string', 'max:100'],
            'chapters.*.icon'          => ['nullable', 'string', 'max:60'],
            'chapters.*.tag'           => ['nullable', 'string', 'max:60'],
            'chapters.*.short_title'   => ['nullable', 'string', 'max:255'],
            'chapters.*.short_desc'    => ['nullable', 'string'],
            'chapters.*.long_title'    => ['nullable', 'string', 'max:255'],
            'chapters.*.lead'          => ['nullable', 'string', 'max:255'],
            'chapters.*.body'          => ['nullable', 'string'],
            'chapters.*.note'          => ['nullable', 'string'],

            // Repeater: kepala sekolah
            'principals'                    => ['nullable', 'array'],
            'principals.*.name'             => ['nullable', 'string', 'max:255'],
            'principals.*.period_label'     => ['nullable', 'string', 'max:100'],
            'principals.*.caption'          => ['nullable', 'string'],
            'principals.*.is_current'       => ['nullable', 'boolean'],
            'principals.*.photo'            => ['nullable', 'image', 'max:4096'],
            'principals.*.existing_photo'   => ['nullable', 'string'],

            // Repeater: galeri
            'galleries'                    => ['nullable', 'array'],
            'galleries.*.small_label'      => ['nullable', 'string', 'max:100'],
            'galleries.*.big_label'        => ['nullable', 'string', 'max:255'],
            'galleries.*.is_featured'      => ['nullable', 'boolean'],
            'galleries.*.image'            => ['nullable', 'image', 'max:4096'],
            'galleries.*.existing_image'   => ['nullable', 'string'],
        ]);

        // ---- Field singleton biasa ----
        foreach (['hero_image', 'story_image', 'vt_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($history->{$field}) {
                    Storage::disk('public')->delete($history->{$field});
                }
                $data[$field] = $request->file($field)->store('school-history', 'public');
            } else {
                unset($data[$field]); // jangan timpa kalau tidak upload baru
            }
        }

        $data['story_chips'] = array_values(array_filter($request->input('story_chips', [])));

        $history->update($data);

        // ---- Repeater: bab sejarah (wipe & reinsert, urutan = urutan submit) ----
        $history->chapters()->delete();
        foreach ($request->input('chapters', []) as $i => $row) {
            if (blank($row['short_title'] ?? null) && blank($row['long_title'] ?? null)) {
                continue; // baris kosong (baru ditambah lalu tidak diisi), lewati
            }
            $history->chapters()->create([
                'kicker'      => $row['kicker'] ?? null,
                'year_label'  => $row['year_label'] ?? null,
                'icon'        => $row['icon'] ?? 'fa-flag',
                'tag'         => $row['tag'] ?? null,
                'short_title' => $row['short_title'] ?? null,
                'short_desc'  => $row['short_desc'] ?? null,
                'long_title'  => $row['long_title'] ?? null,
                'lead'        => $row['lead'] ?? null,
                'body'        => $row['body'] ?? null,
                'note'        => $row['note'] ?? null,
                'order'       => $i,
            ]);
        }

        // ---- Repeater: kepala sekolah ----
        $existingPrincipalPhotos = $history->principals()->pluck('photo', 'id');
        $history->principals()->delete();
        foreach ($request->input('principals', []) as $i => $row) {
            if (blank($row['name'] ?? null)) {
                continue;
            }

            $photoPath = $row['existing_photo'] ?? null;
            if ($request->hasFile("principals.$i.photo")) {
                $photoPath = $request->file("principals.$i.photo")->store('school-history/principals', 'public');
            }

            $history->principals()->create([
                'name'         => $row['name'],
                'period_label' => $row['period_label'] ?? null,
                'caption'      => $row['caption'] ?? null,
                'is_current'   => (bool) ($row['is_current'] ?? false),
                'photo'        => $photoPath,
                'order'        => $i,
            ]);
        }
        // Bersihkan file foto lama yang sudah tidak dipakai lagi
        $keptPhotos = $history->principals()->pluck('photo')->filter()->all();
        foreach ($existingPrincipalPhotos as $oldPath) {
            if ($oldPath && !in_array($oldPath, $keptPhotos, true)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // ---- Repeater: galeri mosaic ----
        $existingGalleryImages = $history->galleries()->pluck('image', 'id');
        $history->galleries()->delete();
        foreach ($request->input('galleries', []) as $i => $row) {
            $imagePath = $row['existing_image'] ?? null;
            if ($request->hasFile("galleries.$i.image")) {
                $imagePath = $request->file("galleries.$i.image")->store('school-history/gallery', 'public');
            }
            if (blank($imagePath)) {
                continue;
            }

            $history->galleries()->create([
                'image'       => $imagePath,
                'small_label' => $row['small_label'] ?? null,
                'big_label'   => $row['big_label'] ?? null,
                'is_featured' => (bool) ($row['is_featured'] ?? false),
                'order'       => $i,
            ]);
        }
        $keptImages = $history->galleries()->pluck('image')->filter()->all();
        foreach ($existingGalleryImages as $oldPath) {
            if ($oldPath && !in_array($oldPath, $keptImages, true)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        return redirect()
            ->route('admin.school-history.index')
            ->with('status', 'Konten Sejarah Sekolah berhasil disimpan.');
    }
}
