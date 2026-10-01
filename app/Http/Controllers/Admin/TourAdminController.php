<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourHotspot;
use App\Models\TourScene;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TourAdminController extends Controller
{
    public function index(Request $request)
    {
        $scenes = TourScene::with('hotspots.target')->orderBy('order')->orderBy('id')->get();

        $isNew = $request->boolean('new');
        $selected = null;

        if (!$isNew) {
            $id = $request->query('scene');
            $selected = $id ? $scenes->firstWhere('id', (int) $id) : $scenes->first();
        }

        return view('admin.tour.index', [
            'scenes'   => $scenes,
            'selected' => $selected,
            'isNew'    => $isNew,
        ]);
    }

    /* ===================== SCENE ===================== */

    public function store(Request $request)
    {
        $data = $this->validateScene($request);

        $scene = new TourScene();
        $scene->slug = TourScene::generateUniqueSlug($data['title']);
        $scene->order = ((int) TourScene::max('order')) + 1;
        $this->fillScene($scene, $data, $request);

        // scene pertama otomatis jadi scene awal
        if (TourScene::count() === 0) {
            $scene->is_home = true;
        }

        $scene->save();

        return redirect()->route('admin.tour.index', ['scene' => $scene->id])
            ->with('status', 'Lokasi baru berhasil ditambahkan.');
    }

    public function update(Request $request, TourScene $scene)
    {
        $data = $this->validateScene($request);
        $this->fillScene($scene, $data, $request);
        $scene->save();

        return redirect()->route('admin.tour.index', ['scene' => $scene->id])
            ->with('status', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(TourScene $scene)
    {
        $wasHome = $scene->is_home;

        if ($scene->panorama && Storage::disk('public')->exists($scene->panorama)) {
            Storage::disk('public')->delete($scene->panorama);
        }

        // hotspot yang menunjuk ke scene ini ikut terhapus (cascade di DB)
        $scene->delete();

        if ($wasHome && ($first = TourScene::orderBy('order')->first())) {
            $first->update(['is_home' => true]);
        }

        return redirect()->route('admin.tour.index')
            ->with('status', 'Lokasi berhasil dihapus.');
    }

    /** Geser urutan scene: direction = up | down */
    public function move(TourScene $scene, string $direction)
    {
        $list = TourScene::orderBy('order')->orderBy('id')->get()->values();
        $i = $list->search(fn ($s) => $s->id === $scene->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i !== false && isset($list[$j])) {
            $tmp = $list[$i];
            $list[$i] = $list[$j];
            $list[$j] = $tmp;
            foreach ($list as $idx => $s) {
                if ($s->order !== $idx) {
                    $s->update(['order' => $idx]);
                }
            }
        }

        return redirect()->route('admin.tour.index', ['scene' => $scene->id]);
    }

    /* ===================== HOTSPOT ===================== */

    public function storeHotspot(Request $request, TourScene $scene)
    {
        $data = $this->validateHotspot($request, $scene->id);
        $data['order'] = ((int) $scene->hotspots()->max('order')) + 1;
        $scene->hotspots()->create($data);

        return redirect()->route('admin.tour.index', ['scene' => $scene->id])
            ->with('status', 'Hotspot berhasil ditambahkan.');
    }

    public function updateHotspot(Request $request, TourHotspot $hotspot)
    {
        $data = $this->validateHotspot($request, $hotspot->tour_scene_id);
        $hotspot->update($data);

        return redirect()->route('admin.tour.index', ['scene' => $hotspot->tour_scene_id])
            ->with('status', 'Hotspot berhasil diperbarui.');
    }

    public function destroyHotspot(TourHotspot $hotspot)
    {
        $sceneId = $hotspot->tour_scene_id;
        $hotspot->delete();

        return redirect()->route('admin.tour.index', ['scene' => $sceneId])
            ->with('status', 'Hotspot berhasil dihapus.');
    }

    /* ===================== HELPERS ===================== */

    private function validateScene(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', Rule::in(['area', 'kelas', 'fasilitas'])],
            'icon'        => ['nullable', 'string', 'max:60'],
            'description' => ['nullable', 'string'],
            'panorama'    => ['nullable', 'image', 'max:30720'], // 30 MB
            'haov'        => ['nullable', 'integer', 'min:1', 'max:360'],
            'vaov'        => ['nullable', 'numeric', 'min:1', 'max:360'],
            'v_offset'    => ['nullable', 'integer', 'min:-90', 'max:90'],
            'is_home'     => ['nullable', 'boolean'],
        ]);
    }

    private function validateHotspot(Request $request, int $sceneId): array
    {
        $data = $request->validate([
            'target_scene_id' => ['required', 'exists:tour_scenes,id', Rule::notIn([$sceneId])],
            'pitch'           => ['required', 'numeric', 'between:-90,90'],
            'yaw'             => ['required', 'numeric', 'between:-180,180'],
            'label'           => ['required', 'string', 'max:120'],
            'icon'            => ['nullable', 'string', 'max:60'],
        ]);

        $data['icon'] = $this->cleanIcon($data['icon'] ?? null, 'fa-plus');

        return $data;
    }

    private function fillScene(TourScene $scene, array $data, Request $request): void
    {
        $scene->title       = $data['title'];
        $scene->category    = $data['category'];
        $scene->icon        = $this->cleanIcon($data['icon'] ?? null, $scene->icon ?: 'fa-archway');
        $scene->description = $data['description'] ?? null;
        $scene->haov        = $data['haov'] ?? ($scene->haov ?: 360);
        $scene->v_offset    = $data['v_offset'] ?? ($scene->v_offset ?: 0);

        if ($request->hasFile('panorama')) {
            $old = $scene->panorama;
            [$path, $autoVaov] = $this->storePanorama($request->file('panorama'));
            $scene->panorama = $path;
            // vaov dihitung otomatis dari dimensi foto, kecuali admin isi manual
            $scene->vaov = $data['vaov'] ?? $autoVaov;

            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
        } elseif (isset($data['vaov'])) {
            $scene->vaov = $data['vaov'];
        } elseif (!$scene->exists) {
            $scene->vaov = 180;
        }

        if ($request->boolean('is_home')) {
            TourScene::when($scene->exists, fn ($q) => $q->where('id', '!=', $scene->id))
                ->update(['is_home' => false]);
            $scene->is_home = true;
        } elseif ($scene->exists && $scene->is_home) {
            // scene awal tidak boleh "dimatikan" begitu saja — pilih scene lain untuk jadi awal
            $scene->is_home = true;
        }
    }

    /** Terima "fa-flag" / "fas fa-flag" / "fa-solid fa-flag" -> simpan "fa-flag". */
    private function cleanIcon(?string $icon, string $fallback): string
    {
        if (!$icon) {
            return $fallback;
        }
        preg_match_all('/fa-[a-z0-9-]+/i', $icon, $m);
        $skip = ['fa-solid', 'fa-regular', 'fa-brands', 'fa-light', 'fa-fw'];
        foreach ($m[0] as $c) {
            if (!in_array(strtolower($c), $skip, true)) {
                return strtolower($c);
            }
        }
        return $fallback;
    }

    /** Simpan foto + hitung vaov = 360 * tinggi / lebar. */
    private function storePanorama(UploadedFile $file): array
    {
        $path = $file->store('tour-panoramas', 'public');

        $vaov = 180;
        $size = @getimagesize(Storage::disk('public')->path($path));
        if ($size && $size[0] > 0) {
            $vaov = min(180, round(360 * ($size[1] / $size[0]), 2));
        }

        return [$path, $vaov];
    }
}
