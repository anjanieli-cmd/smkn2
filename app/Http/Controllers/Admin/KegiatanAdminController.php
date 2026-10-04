<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanAlbum;
use App\Models\KegiatanCategory;
use App\Models\KegiatanMonth;
use App\Models\KegiatanPhoto;
use App\Models\KegiatanPlacement;
use App\Models\KegiatanSetting;
use App\Support\KegiatanMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanAdminController extends Controller
{
    private const TABS = [
        'album'    => ['Album Kegiatan', 'fa-images'],
        'sorotan'  => ['Sorotan', 'fa-star'],
        'kalender' => ['Kalender Tahunan', 'fa-calendar-days'],
        'kategori' => ['Kategori', 'fa-tags'],
        'teks'     => ['Teks Halaman', 'fa-pen-to-square'],
    ];

    /** key => wajib diisi? */
    private const SETTINGS_FIELDS = [
        'hero_kicker' => false, 'hero_title_1' => true, 'hero_title_2' => true, 'hero_lead' => false,
        'hero_pill_1' => false, 'hero_pill_2' => false, 'hero_pill_3' => false,
        'intro_eyebrow' => false, 'intro_title_1' => true, 'intro_title_2' => false, 'intro_title_em' => false,
        'intro_text' => false, 'intro_pill' => false,
        'stat_1_num' => false, 'stat_1_label' => false, 'stat_2_num' => false, 'stat_2_label' => false,
        'stat_3_num' => false, 'stat_3_label' => false, 'stat_4_num' => false, 'stat_4_label' => false,
        'quote_text' => false, 'quote_author' => false, 'quote_stamp' => false,
        'gallery_eyebrow' => false, 'gallery_title' => true, 'gallery_title_em' => false,
        'gallery_text' => false, 'gallery_search_hint' => false,
        'year_eyebrow' => false, 'year_title' => true, 'year_title_em' => false, 'year_text' => false,
        'picks_eyebrow' => false, 'picks_title' => true, 'picks_title_em' => false, 'picks_text' => false,
        'cta_title' => true, 'cta_title_em' => false, 'cta_text' => false,
        'cta_btn_text' => true, 'cta_btn_url' => false,
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'album');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'album';
        }

        $albums = KegiatanAlbum::ordered()->with('photos')->get();

        $placements = KegiatanPlacement::orderBy('slot')->orderBy('position')->get()
            ->groupBy('slot')
            ->map(fn ($rows) => $rows->keyBy('position'));

        return view('admin.kegiatan.index', [
            'tabs'       => self::TABS,
            'tab'        => $tab,
            's'          => KegiatanSetting::allValues(),
            'albums'     => $albums,
            'categories' => KegiatanCategory::orderBy('order')->orderBy('id')->get(),
            'placements' => $placements,
            'months'     => KegiatanMonth::ordered()->get(),
        ]);
    }

    /* ===================== TEKS ===================== */

    public function updateSettings(Request $request)
    {
        $rules = [];
        foreach (self::SETTINGS_FIELDS as $key => $required) {
            $rules[$key] = [$required ? 'required' : 'nullable', 'string', 'max:2000'];
        }
        $rules['cta_btn_url'] = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];

        $data = $request->validate($rules, [
            'cta_btn_url.regex' => 'Link tombol harus diawali http://, https://, / atau #.',
        ]);

        KegiatanSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        return $this->back('teks', 'Perubahan berhasil disimpan.');
    }

    /* ===================== ALBUM ===================== */

    public function storeAlbum(Request $request)
    {
        $data = $this->validateAlbum($request);

        $data['order'] = ((int) KegiatanAlbum::max('order')) + 1;
        $data['photo'] = $request->hasFile('photo') ? $request->file('photo')->store('kegiatan', 'public') : null;

        $album = KegiatanAlbum::create($data);
        $this->storeExtraPhotos($request, $album);

        return $this->back('album', 'Album berhasil ditambahkan.');
    }

    public function updateAlbum(Request $request, KegiatanAlbum $album)
    {
        $data = $this->validateAlbum($request);

        if ($request->hasFile('photo')) {
            KegiatanMedia::delete($album->photo);
            $data['photo'] = $request->file('photo')->store('kegiatan', 'public');
        } elseif ($request->boolean('remove_photo')) {
            KegiatanMedia::delete($album->photo);
            $data['photo'] = null;
        }

        $album->update($data);

        // hapus foto tambahan yang dicentang
        $removeIds = array_filter((array) $request->input('remove_photos', []), 'is_numeric');
        if ($removeIds) {
            $album->photos()->whereIn('id', $removeIds)->get()->each(function (KegiatanPhoto $p) {
                KegiatanMedia::delete($p->path);
                $p->delete();
            });
        }

        $this->storeExtraPhotos($request, $album);

        return $this->back('album', 'Album berhasil diperbarui.');
    }

    public function destroyAlbum(KegiatanAlbum $album)
    {
        KegiatanMedia::delete($album->photo);
        foreach ($album->photos as $p) {
            KegiatanMedia::delete($p->path);
        }

        // foto & penempatan ikut terhapus lewat cascade, tapi hapus eksplisit agar aman di semua DB
        $album->photos()->delete();
        KegiatanPlacement::where('album_id', $album->id)->delete();
        $album->delete();

        return $this->back('album', 'Album berhasil dihapus beserta foto dan penempatannya.');
    }

    public function toggleAlbum(KegiatanAlbum $album)
    {
        $album->update(['is_active' => !$album->is_active]);

        return $this->back('album', $album->is_active ? 'Album ditampilkan.' : 'Album disembunyikan dari halaman publik.');
    }

    public function moveAlbum(KegiatanAlbum $album, string $direction)
    {
        $this->swap(KegiatanAlbum::ordered(), $album, $direction);

        return redirect()->route('admin.kegiatan.index', ['tab' => 'album']);
    }

    /* ===================== SOROTAN ===================== */

    public function updatePlacements(Request $request)
    {
        $rules = [];
        foreach (KegiatanPlacement::SLOT_CAPACITY as $slot => $max) {
            $rules[$slot] = ['nullable', 'array', 'max:' . $max];
            $rules["$slot.*.album_id"] = ['nullable', 'exists:kegiatan_albums,id'];
            $rules["$slot.*.label"] = ['nullable', 'string', 'max:255'];
        }

        $data = $request->validate($rules);

        foreach (KegiatanPlacement::SLOTS as $slot) {
            KegiatanPlacement::where('slot', $slot)->delete();

            $position = 0;
            foreach (($data[$slot] ?? []) as $row) {
                if (empty($row['album_id'])) {
                    continue;
                }

                KegiatanPlacement::create([
                    'slot'     => $slot,
                    'position' => $position++,
                    'album_id' => $row['album_id'],
                    'label'    => isset($row['label']) && trim($row['label']) !== '' ? trim($row['label']) : null,
                ]);
            }
        }

        return $this->back('sorotan', 'Sorotan berhasil disimpan.');
    }

    /* ===================== KALENDER ===================== */

    public function storeMonth(Request $request)
    {
        $data = $this->validateMonth($request);
        $data['order'] = ((int) KegiatanMonth::max('order')) + 1;
        $data['is_active'] = true;
        KegiatanMonth::create($data);

        return $this->back('kalender', 'Bulan berhasil ditambahkan.');
    }

    public function updateMonth(Request $request, KegiatanMonth $month)
    {
        $month->update($this->validateMonth($request));

        return $this->back('kalender', 'Bulan berhasil diperbarui.');
    }

    public function destroyMonth(KegiatanMonth $month)
    {
        $month->delete();

        return $this->back('kalender', 'Bulan berhasil dihapus.');
    }

    public function toggleMonth(KegiatanMonth $month)
    {
        $month->update(['is_active' => !$month->is_active]);

        return $this->back('kalender', $month->is_active ? 'Bulan ditampilkan.' : 'Bulan disembunyikan dari halaman publik.');
    }

    public function moveMonth(KegiatanMonth $month, string $direction)
    {
        $this->swap(KegiatanMonth::ordered(), $month, $direction);

        return redirect()->route('admin.kegiatan.index', ['tab' => 'kalender']);
    }

    /* ===================== KATEGORI ===================== */

    public function storeCategory(Request $request)
    {
        $data = $this->validateCategory($request);

        $base = Str::slug($data['label']) ?: 'kategori';
        $key = $base;
        $n = 2;
        while (KegiatanCategory::where('key', $key)->exists()) {
            $key = $base . '-' . $n++;
        }

        KegiatanCategory::create([
            'key'   => $key,
            'label' => $data['label'],
            'icon'  => $data['icon'] ?: 'fa-flag',
            'order' => ((int) KegiatanCategory::max('order')) + 1,
        ]);

        return $this->back('kategori', 'Kategori berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, KegiatanCategory $category)
    {
        $data = $this->validateCategory($request);

        $category->update(['label' => $data['label'], 'icon' => $data['icon'] ?: 'fa-flag']);

        return $this->back('kategori', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(KegiatanCategory $category)
    {
        KegiatanAlbum::where('category_key', $category->key)->update(['category_key' => null]);
        $category->delete();

        return $this->back('kategori', 'Kategori dihapus. Album yang memakainya kini tanpa kategori.');
    }

    public function moveCategory(KegiatanCategory $category, string $direction)
    {
        $this->swap(KegiatanCategory::orderBy('order')->orderBy('id'), $category, $direction);

        return redirect()->route('admin.kegiatan.index', ['tab' => 'kategori']);
    }

    /* ===================== HELPERS ===================== */

    private function validateAlbum(Request $request): array
    {
        $data = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'category_key'    => ['nullable', 'string', 'exists:kegiatan_categories,key'],
            'date_label'      => ['nullable', 'string', 'max:120'],
            'description'     => ['nullable', 'string', 'max:2000'],
            'size'            => ['required', 'in:' . implode(',', array_keys(KegiatanAlbum::SIZES))],
            'photo'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_photo'    => ['nullable', 'boolean'],
            'photos'          => ['nullable', 'array', 'max:20'],
            'photos.*'        => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_photos'   => ['nullable', 'array'],
            'show_in_gallery' => ['nullable', 'boolean'],
            'is_active'       => ['nullable', 'boolean'],
        ], [
            'photo.image'    => 'File foto sampul harus berupa gambar.',
            'photo.mimes'    => 'Foto sampul harus berformat JPG, PNG, atau WEBP.',
            'photo.max'      => 'Ukuran foto sampul maksimal 4 MB.',
            'photos.max'     => 'Maksimal 20 foto tambahan sekali upload.',
            'photos.*.image' => 'Semua foto tambahan harus berupa gambar.',
            'photos.*.mimes' => 'Foto tambahan harus berformat JPG, PNG, atau WEBP.',
            'photos.*.max'   => 'Ukuran tiap foto tambahan maksimal 4 MB.',
        ]);

        $data['show_in_gallery'] = $request->boolean('show_in_gallery');
        $data['is_active'] = $request->boolean('is_active');
        unset($data['photo'], $data['photos'], $data['remove_photo'], $data['remove_photos']);

        return $data;
    }

    private function validateMonth(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:20'],
            'event' => ['required', 'string', 'max:255'],
            'note'  => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:60'],
            'icon'  => ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'],
        ], [
            'icon.regex' => 'Ikon harus berupa nama class FontAwesome, mis. fa-trophy.',
        ]);
    }

    private function storeExtraPhotos(Request $request, KegiatanAlbum $album): void
    {
        if (!$request->hasFile('photos')) {
            return;
        }

        $order = ((int) $album->photos()->max('order')) + 1;

        foreach ($request->file('photos') as $file) {
            $album->photos()->create([
                'path'  => $file->store('kegiatan/galeri', 'public'),
                'order' => $order++,
            ]);
        }
    }

    /** Tukar posisi item dengan tetangganya, lalu rapikan urutan 0..n. */
    private function swap(Builder $query, $item, string $direction): void
    {
        $list = $query->get()->values();
        $i = $list->search(fn ($x) => $x->id === $item->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i === false || !isset($list[$j])) {
            return;
        }

        $tmp = $list[$i];
        $list[$i] = $list[$j];
        $list[$j] = $tmp;

        foreach ($list as $idx => $row) {
            if ($row->order !== $idx) {
                $row->update(['order' => $idx]);
            }
        }
    }

    private function back(string $tab, string $message)
    {
        return redirect()->route('admin.kegiatan.index', ['tab' => $tab])->with('status', $message);
    }
}
