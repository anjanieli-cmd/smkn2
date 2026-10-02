<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbItem;
use App\Models\PpdbSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpdbAdminController extends Controller
{
    /** Tab: "teks" + satu tab per section di PpdbItem::SECTIONS */
    private function tabs(): array
    {
        $tabs = ['teks' => ['Hero & Penutup', 'fa-star']];

        foreach (PpdbItem::SECTIONS as $key => $cfg) {
            $tabs[$key] = [$cfg['tab'], $cfg['icon_tab']];
        }

        return $tabs;
    }

    public function index(Request $request)
    {
        $tabs = $this->tabs();
        $tab = $request->query('tab', 'teks');
        if (!array_key_exists($tab, $tabs)) {
            $tab = 'teks';
        }

        $items = collect();
        $selected = null;
        $isNew = false;

        if ($tab !== 'teks') {
            $items = PpdbItem::ofSection($tab)->ordered()->get();
            $isNew = $request->boolean('new');

            if (!$isNew && $request->query('item')) {
                $selected = $items->firstWhere('id', (int) $request->query('item'));
            }
        }

        return view('admin.ppdb.index', [
            'tabs'     => $tabs,
            'tab'      => $tab,
            'cfg'      => PpdbItem::SECTIONS[$tab] ?? null,
            's'        => PpdbSetting::allValues(),
            'items'    => $items,
            'selected' => $selected,
            'isNew'    => $isNew,
        ]);
    }

    /* ===================== TEKS (SETTINGS) ===================== */

    public function updateSettings(Request $request, string $tab)
    {
        $fields = PpdbSetting::fieldsFor($tab);
        abort_if(empty($fields), 404);

        $rules = [];
        foreach ($fields as $key => $f) {
            $rules[$key] = [$f[3] ? 'required' : 'nullable', 'string', 'max:' . $f[4]];
        }
        if (isset($fields['cta_button_url'])) {
            $rules['cta_button_url'] = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];
        }
        if ($tab === 'definisi') {
            $rules['banner']       = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
            $rules['reset_banner'] = ['nullable', 'boolean'];
        }

        $data = $request->validate($rules, [
            'cta_button_url.regex' => 'Link tombol harus diawali http://, https://, / atau #.',
            'banner.image'         => 'Banner harus berupa gambar (jpg, png, atau webp).',
            'banner.mimes'         => 'Banner harus berformat jpg, png, atau webp.',
            'banner.max'           => 'Ukuran banner maksimal 5 MB.',
        ]);

        $save = array_intersect_key($data, $fields);
        $save = array_map(fn ($v) => (string) $v, $save);

        if ($tab === 'definisi') {
            $current = PpdbSetting::allValues()['intro_banner'];

            if ($request->hasFile('banner')) {
                $this->deleteFile($current);
                $save['intro_banner'] = $request->file('banner')->store('ppdb-photos', 'public');
            } elseif ($request->boolean('reset_banner')) {
                $this->deleteFile($current);
                $save['intro_banner'] = PpdbSetting::defaults()['intro_banner'];
            }
        }

        PpdbSetting::putMany($save);

        return $this->back($tab, 'Perubahan berhasil disimpan.');
    }

    /* ===================== DAFTAR (ITEM) ===================== */

    public function storeItem(Request $request, string $section)
    {
        abort_unless(isset(PpdbItem::SECTIONS[$section]), 404);

        $data = $this->validateItem($request, $section);

        $item = new PpdbItem();
        $item->section = $section;
        $item->order = ((int) PpdbItem::ofSection($section)->max('order')) + 1;
        $this->fillItem($item, $data, $request, $section);
        $item->save();

        return $this->back($section, 'Data baru berhasil ditambahkan.');
    }

    public function updateItem(Request $request, PpdbItem $item)
    {
        $data = $this->validateItem($request, $item->section);
        $this->fillItem($item, $data, $request, $item->section);
        $item->save();

        return $this->back($item->section, 'Data berhasil diperbarui.');
    }

    public function destroyItem(PpdbItem $item)
    {
        $this->deleteFile($item->photo);
        $section = $item->section;
        $item->delete();

        return $this->back($section, 'Data berhasil dihapus.');
    }

    public function toggleItem(PpdbItem $item)
    {
        $item->update(['is_active' => !$item->is_active]);

        return $this->back($item->section, $item->is_active ? 'Ditampilkan di halaman publik.' : 'Disembunyikan dari halaman publik.');
    }

    /** Geser urutan dalam section yang sama: direction = up | down */
    public function moveItem(PpdbItem $item, string $direction)
    {
        $list = PpdbItem::ofSection($item->section)->ordered()->get()->values();

        $i = $list->search(fn ($x) => $x->id === $item->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i !== false && isset($list[$j])) {
            $tmp = $list[$i];
            $list[$i] = $list[$j];
            $list[$j] = $tmp;

            foreach ($list as $idx => $row) {
                if ($row->order !== $idx) {
                    $row->update(['order' => $idx]);
                }
            }
        }

        return redirect()->route('admin.ppdb.index', ['tab' => $item->section]);
    }

    /* ===================== HELPERS ===================== */

    private function validateItem(Request $request, string $section): array
    {
        $cfg = PpdbItem::SECTIONS[$section];

        $rules = [
            'title'     => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ];
        if ($cfg['label']) {
            $rules['label'] = ['nullable', 'string', 'max:255'];
        }
        if ($cfg['text']) {
            $rules['text'] = ['nullable', 'string', 'max:2000'];
        }
        if ($cfg['icon']) {
            $rules['icon'] = ['nullable', 'string', 'max:60'];
        }
        if ($cfg['photo']) {
            $rules['photo']        = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
            $rules['remove_photo'] = ['nullable', 'boolean'];
        }

        $data = $request->validate($rules, [
            'photo.image' => 'Foto harus berupa gambar (jpg, png, atau webp).',
            'photo.mimes' => 'Foto harus berformat jpg, png, atau webp.',
            'photo.max'   => 'Ukuran foto maksimal 5 MB.',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function fillItem(PpdbItem $item, array $data, Request $request, string $section): void
    {
        $cfg = PpdbItem::SECTIONS[$section];

        $item->title     = $data['title'];
        $item->is_active = $data['is_active'];

        if ($cfg['label']) {
            $item->label = $data['label'] ?? null;
        }
        if ($cfg['text']) {
            $item->text = $data['text'] ?? null;
        }
        if ($cfg['icon']) {
            $item->icon = $this->cleanIcon($data['icon'] ?? null, $item->icon ?: 'fa-star');
        }
        if ($cfg['photo']) {
            if ($request->hasFile('photo')) {
                $old = $item->photo;
                $item->photo = $request->file('photo')->store('ppdb-photos', 'public');
                $this->deleteFile($old);
            } elseif ($request->boolean('remove_photo') && $item->photo) {
                $this->deleteFile($item->photo);
                $item->photo = null;
            }
        }
    }

    /** Hanya menghapus file di storage; file lama di public/images tidak disentuh. */
    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
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

    private function back(string $tab, string $message)
    {
        return redirect()->route('admin.ppdb.index', ['tab' => $tab])->with('status', $message);
    }
}
