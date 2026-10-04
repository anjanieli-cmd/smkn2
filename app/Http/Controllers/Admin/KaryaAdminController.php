<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaryaCategory;
use App\Models\KaryaSetting;
use App\Models\KaryaWork;
use App\Support\KaryaMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KaryaAdminController extends Controller
{
    private const TABS = [
        'karya'    => ['Daftar Karya', 'fa-lightbulb'],
        'kategori' => ['Bidang / Kategori', 'fa-tags'],
        'teks'     => ['Teks Halaman', 'fa-pen-to-square'],
    ];

    /** key => wajib diisi? */
    private const SETTINGS_FIELDS = [
        'hero_kicker' => false, 'hero_title_1' => true, 'hero_title_2' => true,
        'intro_title' => true, 'intro_title_em' => false, 'intro_note' => false,
        'stat_1_num' => false, 'stat_1_label' => false,
        'stat_2_num' => false, 'stat_2_label' => false,
        'stat_3_num' => false, 'stat_3_label' => false,
        'cat_line' => false, 'blurb_1' => false, 'blurb_2' => false,
        'slider_title' => true, 'slider_title_em' => false, 'slider_note' => false,
        'kat_title' => true, 'kat_title_em' => false, 'kat_note' => false,
        'prod_title' => true, 'prod_title_em' => false, 'prod_note' => false,
        'cta_title' => true, 'cta_title_em' => false, 'cta_text' => false,
        'cta_btn_text' => true, 'cta_btn_url' => false, 'cta_note' => false,
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'karya');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'karya';
        }

        return view('admin.karya.index', [
            'tabs'       => self::TABS,
            'tab'        => $tab,
            's'          => KaryaSetting::allValues(),
            'works'      => KaryaWork::ordered()->get(),
            'categories' => KaryaCategory::orderBy('order')->orderBy('id')->get(),
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

        KaryaSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        return $this->back('teks', 'Perubahan berhasil disimpan.');
    }

    /* ===================== KARYA ===================== */

    public function storeWork(Request $request)
    {
        $data = $this->validateWork($request);

        $data['order'] = ((int) KaryaWork::max('order')) + 1;
        $data['photo'] = $request->hasFile('photo') ? $request->file('photo')->store('karya', 'public') : null;

        KaryaWork::create($data);

        return $this->back('karya', 'Karya berhasil ditambahkan.');
    }

    public function updateWork(Request $request, KaryaWork $work)
    {
        $data = $this->validateWork($request);

        if ($request->hasFile('photo')) {
            KaryaMedia::delete($work->photo);
            $data['photo'] = $request->file('photo')->store('karya', 'public');
        } elseif ($request->boolean('remove_photo')) {
            KaryaMedia::delete($work->photo);
            $data['photo'] = null;
        }

        $work->update($data);

        return $this->back('karya', 'Karya berhasil diperbarui.');
    }

    public function destroyWork(KaryaWork $work)
    {
        KaryaMedia::delete($work->photo);
        $work->delete();

        return $this->back('karya', 'Karya berhasil dihapus.');
    }

    public function toggleWork(KaryaWork $work)
    {
        $work->update(['is_active' => !$work->is_active]);

        return $this->back('karya', $work->is_active ? 'Karya ditampilkan.' : 'Karya disembunyikan dari halaman publik.');
    }

    /**
     * Naik/turun. Satu urutan dipakai bersama oleh slider dan kartu produk, jadi karya
     * ditukar dengan tetangga terdekat yang tampil di bagian yang sama (slider / produk);
     * kalau tidak ada, ditukar dengan tetangga langsung.
     */
    public function moveWork(KaryaWork $work, string $direction)
    {
        $list = KaryaWork::ordered()->get()->values();
        $i = $list->search(fn ($x) => $x->id === $work->id);

        if ($i !== false) {
            $step = $direction === 'up' ? -1 : 1;
            $j = null;

            for ($k = $i + $step; isset($list[$k]); $k += $step) {
                $n = $list[$k];
                if (($work->show_in_slider && $n->show_in_slider) || ($work->show_in_products && $n->show_in_products)) {
                    $j = $k;
                    break;
                }
            }
            $j ??= isset($list[$i + $step]) ? $i + $step : null;

            if ($j !== null) {
                $tmp = $list[$i];
                $list[$i] = $list[$j];
                $list[$j] = $tmp;

                foreach ($list as $idx => $row) {
                    if ($row->order !== $idx) {
                        $row->update(['order' => $idx]);
                    }
                }
            }
        }

        return redirect()->route('admin.karya.index', ['tab' => 'karya']);
    }

    /* ===================== KATEGORI ===================== */

    public function storeCategory(Request $request)
    {
        $data = $this->validateCategory($request);

        $base = Str::slug($data['label']) ?: 'bidang';
        $key = $base;
        $n = 2;
        while (KaryaCategory::where('key', $key)->exists()) {
            $key = $base . '-' . $n++;
        }

        KaryaCategory::create([
            'key'         => $key,
            'label'       => $data['label'],
            'icon'        => $data['icon'] ?: 'fa-star',
            'description' => $data['description'] ?? null,
            'order'       => ((int) KaryaCategory::max('order')) + 1,
        ]);

        return $this->back('kategori', 'Bidang berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, KaryaCategory $category)
    {
        $data = $this->validateCategory($request);

        $category->update([
            'label'       => $data['label'],
            'icon'        => $data['icon'] ?: 'fa-star',
            'description' => $data['description'] ?? null,
        ]);

        return $this->back('kategori', 'Bidang berhasil diperbarui.');
    }

    public function destroyCategory(KaryaCategory $category)
    {
        KaryaWork::where('category_key', $category->key)->update(['category_key' => null]);
        $category->delete();

        return $this->back('kategori', 'Bidang dihapus. Karya yang memakainya kini tanpa kategori.');
    }

    public function moveCategory(KaryaCategory $category, string $direction)
    {
        $this->swap(KaryaCategory::orderBy('order')->orderBy('id'), $category, $direction);

        return redirect()->route('admin.karya.index', ['tab' => 'kategori']);
    }

    /* ===================== HELPERS ===================== */

    private function validateWork(Request $request): array
    {
        $icon = ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'];

        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:2000'],
            'category_key'     => ['nullable', 'string', 'exists:karya_categories,key'],
            'tag_label'        => ['nullable', 'string', 'max:100'],
            'tag_icon'         => $icon,
            'student_label'    => ['nullable', 'string', 'max:150'],
            'major_label'      => ['nullable', 'string', 'max:150'],
            'major_icon'       => $icon,
            'major_short'      => ['nullable', 'string', 'max:60'],
            'year_label'       => ['nullable', 'string', 'max:60'],
            'photo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_photo'     => ['nullable', 'boolean'],
            'show_in_slider'   => ['nullable', 'boolean'],
            'show_in_products' => ['nullable', 'boolean'],
            'is_active'        => ['nullable', 'boolean'],
        ], [
            'photo.image'    => 'File foto harus berupa gambar.',
            'photo.mimes'    => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'photo.max'      => 'Ukuran foto maksimal 4 MB.',
            'tag_icon.regex'   => 'Ikon label harus berupa class FontAwesome, mis. fa-utensils.',
            'major_icon.regex' => 'Ikon jurusan harus berupa class FontAwesome, mis. fa-laptop-code.',
        ]);

        $data['show_in_slider'] = $request->boolean('show_in_slider');
        $data['show_in_products'] = $request->boolean('show_in_products');
        $data['is_active'] = $request->boolean('is_active');
        unset($data['photo'], $data['remove_photo']);

        return $data;
    }

    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'label'       => ['required', 'string', 'max:60'],
            'icon'        => ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'],
            'description' => ['nullable', 'string', 'max:255'],
        ], [
            'icon.regex' => 'Ikon harus berupa nama class FontAwesome, mis. fa-code.',
        ]);
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
        return redirect()->route('admin.karya.index', ['tab' => $tab])->with('status', $message);
    }
}
