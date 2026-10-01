<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiItem;
use App\Models\VisiMisiSetting;
use Illuminate\Http\Request;

class VisiMisiAdminController extends Controller
{
    /** Tab di halaman admin: key => [label, ikon] */
    private const TABS = [
        'hero'   => ['Hero & CTA', 'fa-star'],
        'visi'   => ['Visi', 'fa-eye'],
        'misi'   => ['Misi', 'fa-list-check'],
        'tujuan' => ['Tujuan', 'fa-flag'],
        'nilai'  => ['Nilai-nilai', 'fa-gem'],
    ];

    /** Key setting yang boleh disimpan per tab + apakah wajib diisi. */
    private const FIELDS = [
        'hero' => [
            'hero_kicker' => false, 'hero_title_1' => true, 'hero_title_2' => true, 'hero_lead' => false,
            'hero_pill_1' => false, 'hero_pill_2' => false, 'hero_pill_3' => false,
            'cta_title' => true, 'cta_title_gold' => false, 'cta_text' => false,
            'cta_button_text' => true, 'cta_button_url' => false,
        ],
        'visi' => [
            'visi_statement' => true, 'visi_tags' => false,
        ],
        'misi' => [
            'misi_eyebrow' => false, 'misi_heading' => true, 'misi_heading_gold' => false, 'misi_desc' => false,
        ],
        'tujuan' => [
            'tujuan_eyebrow' => false, 'tujuan_heading' => true, 'tujuan_heading_gold' => false,
        ],
        'nilai' => [
            'nilai_eyebrow' => false, 'nilai_heading' => true, 'nilai_heading_gold' => false, 'nilai_desc' => false,
        ],
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'hero');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'hero';
        }

        $items = in_array($tab, VisiMisiItem::TYPES, true)
            ? VisiMisiItem::ofType($tab)->get()
            : collect();

        return view('admin.visi-misi.index', [
            'tabs'  => self::TABS,
            'tab'   => $tab,
            's'     => VisiMisiSetting::allValues(),
            'items' => $items,
        ]);
    }

    /* ===================== TEKS (SETTINGS) ===================== */

    public function updateSettings(Request $request, string $tab)
    {
        abort_unless(isset(self::FIELDS[$tab]), 404);

        $rules = [];
        foreach (self::FIELDS[$tab] as $key => $required) {
            $rules[$key] = [$required ? 'required' : 'nullable', 'string', 'max:2000'];
        }
        if ($tab === 'hero') {
            $rules['cta_button_url'] = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];
        }

        $data = $request->validate($rules, [
            'cta_button_url.regex' => 'Link tombol harus diawali http://, https://, / atau #.',
        ]);

        VisiMisiSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        return redirect()->route('admin.visi-misi.index', ['tab' => $tab])
            ->with('status', 'Perubahan berhasil disimpan.');
    }

    /* ===================== ITEM (MISI / TUJUAN / NILAI) ===================== */

    public function storeItem(Request $request)
    {
        $data = $this->validateItem($request);
        $data['order'] = ((int) VisiMisiItem::where('type', $data['type'])->max('order')) + 1;
        VisiMisiItem::create($data);

        return $this->back($data['type'], 'Item berhasil ditambahkan.');
    }

    public function updateItem(Request $request, VisiMisiItem $item)
    {
        $data = $this->validateItem($request);
        unset($data['type']); // tipe tidak boleh berubah
        $item->update($data);

        return $this->back($item->type, 'Item berhasil diperbarui.');
    }

    public function destroyItem(VisiMisiItem $item)
    {
        $type = $item->type;
        $item->delete();

        return $this->back($type, 'Item berhasil dihapus.');
    }

    public function toggleItem(VisiMisiItem $item)
    {
        $item->update(['is_active' => !$item->is_active]);

        return $this->back($item->type, $item->is_active ? 'Item ditampilkan.' : 'Item disembunyikan dari halaman publik.');
    }

    /** direction = up | down */
    public function moveItem(VisiMisiItem $item, string $direction)
    {
        $list = VisiMisiItem::ofType($item->type)->get()->values();
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

        return redirect()->route('admin.visi-misi.index', ['tab' => $item->type]);
    }

    /* ===================== HELPERS ===================== */

    private function validateItem(Request $request): array
    {
        $data = $request->validate([
            'type'      => ['required', 'in:' . implode(',', VisiMisiItem::TYPES)],
            'icon'      => ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'],
            'title'     => ['required', 'string', 'max:255'],
            'text'      => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'icon.regex' => 'Ikon harus berupa nama class FontAwesome, contoh: fa-book-open',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function back(string $tab, string $message)
    {
        return redirect()->route('admin.visi-misi.index', ['tab' => $tab])->with('status', $message);
    }
}
