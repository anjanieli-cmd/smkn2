<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturMember;
use App\Models\StrukturRole;
use App\Models\StrukturSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StrukturAdminController extends Controller
{
    /** Tab di halaman admin: key => [label, ikon] */
    private const TABS = [
        'hero'     => ['Hero & Teks Halaman', 'fa-star'],
        'struktur' => ['Struktur', 'fa-sitemap'],
        'peran'    => ['Alur Kerja', 'fa-diagram-project'],
    ];

    /** Key setting yang boleh disimpan per tab + apakah wajib diisi. */
    private const FIELDS = [
        'hero' => [
            'hero_title_1' => true, 'hero_title_2' => true, 'hero_vt_title' => true, 'hero_vt_sub' => false,
            'chart_eyebrow' => false, 'chart_heading' => true, 'chart_heading_gold' => false,
            'vt_kicker' => false, 'vt_title' => true, 'vt_title_gold' => false, 'vt_sub' => false,
            'vt_desc' => false, 'vt_button_text' => true, 'vt_button_url' => false,
            'cta_title' => true, 'cta_title_gold' => false, 'cta_text' => false,
            'cta_button_text' => true, 'cta_button_url' => false,
        ],
        'peran' => [
            'roles_eyebrow' => false, 'roles_heading' => true, 'roles_heading_gold' => false, 'roles_desc' => false,
        ],
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'struktur');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'struktur';
        }

        $members = collect();
        $selected = null;
        $isNew = false;
        $newLevel = 2;
        $roles = collect();

        if ($tab === 'struktur') {
            $members = StrukturMember::ordered()->get();
            $isNew = $request->boolean('new');

            if ($isNew) {
                $lvl = (int) $request->query('level', 2);
                $newLevel = isset(StrukturMember::LEVELS[$lvl]) ? $lvl : 2;
            } else {
                $id = $request->query('member');
                $selected = $id ? $members->firstWhere('id', (int) $id) : null;
            }
        } elseif ($tab === 'peran') {
            $roles = StrukturRole::ordered()->get();
        }

        return view('admin.struktur.index', [
            'tabs'     => self::TABS,
            'tab'      => $tab,
            's'        => StrukturSetting::allValues(),
            'members'  => $members,
            'selected' => $selected,
            'isNew'    => $isNew,
            'newLevel' => $newLevel,
            'roles'    => $roles,
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
            $rules['vt_button_url']  = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];
            $rules['cta_button_url'] = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];
        }

        $data = $request->validate($rules, [
            'vt_button_url.regex'  => 'Link tombol Virtual Tour harus diawali http://, https://, / atau #.',
            'cta_button_url.regex' => 'Link tombol penutup harus diawali http://, https://, / atau #.',
        ]);

        StrukturSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        return redirect()->route('admin.struktur.index', ['tab' => $tab])
            ->with('status', 'Perubahan berhasil disimpan.');
    }

    /* ===================== ORANG / JABATAN ===================== */

    public function storeMember(Request $request)
    {
        $data = $this->validateMember($request);
        $this->assertSingleLeader($data, null);

        $member = new StrukturMember();
        $member->order = ((int) StrukturMember::where('level', $data['level'])->max('order')) + 1;
        $this->fillMember($member, $data, $request);
        $member->save();

        return $this->backToMember($member, 'Orang baru berhasil ditambahkan.');
    }

    public function updateMember(Request $request, StrukturMember $member)
    {
        $data = $this->validateMember($request);
        $this->assertSingleLeader($data, $member);

        // pindah level -> taruh di urutan paling bawah level baru
        if ((int) $data['level'] !== $member->level) {
            $member->order = ((int) StrukturMember::where('level', $data['level'])->max('order')) + 1;
        }

        $this->fillMember($member, $data, $request);
        $member->save();

        return $this->backToMember($member, 'Data berhasil diperbarui.');
    }

    public function destroyMember(StrukturMember $member)
    {
        $this->deletePhoto($member->photo);
        $member->delete();

        return redirect()->route('admin.struktur.index', ['tab' => 'struktur'])
            ->with('status', 'Data berhasil dihapus.');
    }

    public function toggleMember(StrukturMember $member)
    {
        $activate = !$member->is_active;

        if ($activate) {
            $this->assertSingleLeader(['level' => $member->level, 'is_active' => true], $member);
        }

        $member->update(['is_active' => $activate]);

        return $this->backToMember($member, $activate ? 'Ditampilkan di halaman publik.' : 'Disembunyikan dari halaman publik.');
    }

    /** Geser urutan dalam level yang sama: direction = up | down */
    public function moveMember(StrukturMember $member, string $direction)
    {
        $list = StrukturMember::where('level', $member->level)->ordered()->get()->values();
        $this->swap($list, $member->id, $direction);

        return redirect()->route('admin.struktur.index', ['tab' => 'struktur']);
    }

    /* ===================== ALUR KERJA (KARTU PERAN) ===================== */

    public function storeRole(Request $request)
    {
        $data = $this->validateRole($request);
        $data['order'] = ((int) StrukturRole::max('order')) + 1;
        StrukturRole::create($data);

        return $this->backToRoles('Kartu berhasil ditambahkan.');
    }

    public function updateRole(Request $request, StrukturRole $role)
    {
        $role->update($this->validateRole($request));

        return $this->backToRoles('Kartu berhasil diperbarui.');
    }

    public function destroyRole(StrukturRole $role)
    {
        $role->delete();

        return $this->backToRoles('Kartu berhasil dihapus.');
    }

    public function toggleRole(StrukturRole $role)
    {
        $role->update(['is_active' => !$role->is_active]);

        return $this->backToRoles($role->is_active ? 'Kartu ditampilkan.' : 'Kartu disembunyikan dari halaman publik.');
    }

    public function moveRole(StrukturRole $role, string $direction)
    {
        $list = StrukturRole::ordered()->get()->values();
        $this->swap($list, $role->id, $direction);

        return redirect()->route('admin.struktur.index', ['tab' => 'peran']);
    }

    /* ===================== HELPERS ===================== */

    private function validateMember(Request $request): array
    {
        $data = $request->validate([
            'level'        => ['required', Rule::in(array_keys(StrukturMember::LEVELS))],
            'bidang'       => ['required', Rule::in(array_keys(StrukturMember::BIDANG))],
            'position'     => ['required', 'string', 'max:255'],
            'person'       => ['nullable', 'string', 'max:255'],
            'badge'        => ['nullable', 'string', 'max:120'],
            'unit'         => ['nullable', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:500'],
            'icon'         => ['nullable', 'string', 'max:60'],
            'tasks'        => ['nullable', 'string', 'max:4000'],
            'note'         => ['nullable', 'string', 'max:500'],
            'photo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5 MB
            'remove_photo' => ['nullable', 'boolean'],
            'is_active'    => ['nullable', 'boolean'],
        ], [
            'photo.image' => 'Foto harus berupa gambar (jpg, png, atau webp).',
            'photo.mimes' => 'Foto harus berformat jpg, png, atau webp.',
            'photo.max'   => 'Ukuran foto maksimal 5 MB.',
        ]);

        $data['level']     = (int) $data['level'];
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function validateRole(Request $request): array
    {
        $data = $request->validate([
            'icon'      => ['nullable', 'string', 'max:60'],
            'title'     => ['required', 'string', 'max:255'],
            'text'      => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['icon']      = $this->cleanIcon($data['icon'] ?? null, 'fa-star');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function fillMember(StrukturMember $member, array $data, Request $request): void
    {
        $member->level       = $data['level'];
        $member->bidang      = $data['bidang'];
        $member->position    = $data['position'];
        $member->person      = $data['person'] ?? null;
        $member->badge       = $data['badge'] ?? null;
        $member->unit        = $data['unit'] ?? null;
        $member->description = $data['description'] ?? null;
        $member->icon        = $this->cleanIcon($data['icon'] ?? null, $member->icon ?: 'fa-user');
        $member->tasks       = $data['tasks'] ?? null;
        $member->note        = $data['note'] ?? null;
        $member->is_active   = $data['is_active'];

        if ($request->hasFile('photo')) {
            $old = $member->photo;
            $member->photo = $request->file('photo')->store('struktur-photos', 'public');
            $this->deletePhoto($old);
        } elseif ($request->boolean('remove_photo') && $member->photo) {
            $this->deletePhoto($member->photo);
            $member->photo = null;
        }
    }

    /** Level 1 (Kepala Sekolah) hanya boleh satu orang aktif. */
    private function assertSingleLeader(array $data, ?StrukturMember $ignore): void
    {
        if ((int) $data['level'] !== 1 || empty($data['is_active'])) {
            return;
        }

        $exists = StrukturMember::where('level', 1)->where('is_active', true)
            ->when($ignore, fn ($q) => $q->where('id', '!=', $ignore->id))
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'level' => 'Level 1 hanya boleh berisi satu orang aktif. Edit data Kepala Sekolah yang sudah ada, atau sembunyikan dulu yang lama.',
            ]);
        }
    }

    /** Hanya menghapus file yang ada di storage; foto lama di public/images tidak disentuh. */
    private function deletePhoto(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /** Tukar posisi item dengan tetangganya lalu rapikan nomor urut. */
    private function swap($list, int $id, string $direction): void
    {
        $i = $list->search(fn ($x) => $x->id === $id);
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

    private function backToMember(StrukturMember $member, string $message)
    {
        return redirect()->route('admin.struktur.index', ['tab' => 'struktur'])
            ->with('status', $message);
    }

    private function backToRoles(string $message)
    {
        return redirect()->route('admin.struktur.index', ['tab' => 'peran'])->with('status', $message);
    }
}