<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BkkIndustry;
use App\Models\BkkJobVacancy;
use App\Models\BkkSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BkkAdminController extends Controller
{
    private const TABS = [
        'lowongan' => ['Lowongan', 'fa-briefcase'],
        'industri' => ['Mitra Industri', 'fa-building'],
        'tentang'  => ['Tentang BKK', 'fa-circle-info'],
        'teks'     => ['Teks Halaman', 'fa-pen-to-square'],
    ];

    /** key => [wajib diisi?, panjang maksimal] */
    private const SETTINGS_FIELDS = [
        // hero
        'hero_kicker' => [false, 150], 'hero_title_1' => [true, 60], 'hero_title_2' => [true, 60],
        'hero_lead' => [false, 1000],
        'hero_pill_1' => [false, 80], 'hero_pill_2' => [false, 80], 'hero_pill_3' => [false, 80],
        // strip
        'strip_label' => [true, 60], 'strip_text' => [false, 600],
        // tentang (judul bagian + kartu)
        'about_eyebrow' => [false, 80], 'about_title' => [true, 80], 'about_title_em' => [false, 80], 'about_sub' => [false, 600],
        'about_card_title' => [true, 150], 'about_p1' => [false, 2500], 'about_p2' => [false, 2500],
        'vision_title' => [true, 80], 'vision_text' => [false, 500], 'vision_quote' => [false, 500],
        // mitra
        'partners_eyebrow' => [false, 80], 'partners_title' => [true, 80], 'partners_title_em' => [false, 80], 'partners_sub' => [false, 600],
        // lowongan
        'jobs_eyebrow' => [false, 80], 'jobs_title' => [true, 80], 'jobs_title_em' => [false, 80], 'jobs_sub' => [false, 600],
        // catatan
        'notice_text' => [false, 600], 'notice_bold' => [false, 150],
        // cta
        'cta_title' => [true, 120], 'cta_title_em' => [false, 120], 'cta_text' => [false, 800],
        'cta_btn_text' => [false, 80], 'cta_btn_url' => [false, 255],
    ];

    private const URL_REGEX = '/^(https?:\/\/|mailto:|\/|#).*/i';

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'lowongan');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'lowongan';
        }

        $allJobs = BkkJobVacancy::sortCollection(BkkJobVacancy::query()->get());

        $counts = ['ALL' => $allJobs->count()];
        foreach (array_keys(BkkJobVacancy::STATUSES) as $st) {
            $counts[$st] = $allJobs->filter(fn ($j) => $j->effective_status === $st)->count();
        }

        $statusFilter = strtoupper((string) $request->query('status', ''));
        if (!array_key_exists($statusFilter, BkkJobVacancy::STATUSES)) {
            $statusFilter = '';
        }

        $jobs = $statusFilter === ''
            ? $allJobs
            : $allJobs->filter(fn ($j) => $j->effective_status === $statusFilter)->values();

        return view('admin.bkk.index', [
            'tabs'         => self::TABS,
            'tab'          => $tab,
            's'            => BkkSetting::allValues(),
            'jobs'         => $jobs,
            'counts'       => $counts,
            'statusFilter' => $statusFilter,
            'industries'   => BkkIndustry::ordered()->get(),
        ]);
    }

    /* ===================== TEKS (hero, strip, tentang, judul, catatan, CTA) ===================== */

    public function updateSettings(Request $request)
    {
        $rules = [];
        foreach (self::SETTINGS_FIELDS as $key => [$required, $max]) {
            $rules[$key] = ['sometimes', $required ? 'required' : 'nullable', 'string', 'max:' . $max];
        }
        $rules['cta_btn_url'] = ['sometimes', 'nullable', 'string', 'max:255', 'regex:' . self::URL_REGEX];

        $data = $request->validate($rules, [
            'cta_btn_url.regex' => 'Link tombol harus diawali http://, https://, mailto:, / atau #.',
        ]);

        BkkSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        $tab = in_array($request->input('_tab'), ['tentang', 'teks'], true) ? $request->input('_tab') : 'teks';

        return $this->back($tab, 'Perubahan berhasil disimpan.');
    }

    public function updatePhotos(Request $request)
    {
        $rules = [];
        foreach ([1, 2, 3] as $n) {
            $rules["photo_$n"] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
            $rules["photo_{$n}_alt"] = ['nullable', 'string', 'max:150'];
            $rules["remove_photo_$n"] = ['nullable', 'boolean'];
        }

        $request->validate($rules, [
            'photo_1.image' => 'Foto 1 harus berupa gambar.', 'photo_1.mimes' => 'Foto 1 harus berformat JPG, PNG, atau WEBP.', 'photo_1.max' => 'Foto 1 maksimal 4 MB.',
            'photo_2.image' => 'Foto 2 harus berupa gambar.', 'photo_2.mimes' => 'Foto 2 harus berformat JPG, PNG, atau WEBP.', 'photo_2.max' => 'Foto 2 maksimal 4 MB.',
            'photo_3.image' => 'Foto 3 harus berupa gambar.', 'photo_3.mimes' => 'Foto 3 harus berformat JPG, PNG, atau WEBP.', 'photo_3.max' => 'Foto 3 maksimal 4 MB.',
        ]);

        $defaults = BkkSetting::defaults();
        $current = BkkSetting::allValues();

        foreach ([1, 2, 3] as $n) {
            $key = "photo_$n";

            if ($request->hasFile($key)) {
                $this->deletePhoto($current[$key]);
                BkkSetting::put($key, $request->file($key)->store('bkk', 'public'));
            } elseif ($request->boolean("remove_photo_$n")) {
                $this->deletePhoto($current[$key]);
                BkkSetting::put($key, $defaults[$key]);
            }

            BkkSetting::put("{$key}_alt", (string) $request->input("{$key}_alt", ''));
        }

        return $this->back('tentang', 'Foto dokumentasi berhasil disimpan.');
    }

    /* ===================== LOWONGAN ===================== */

    public function storeJob(Request $request)
    {
        BkkJobVacancy::create($this->validateJob($request));

        return $this->back('lowongan', 'Lowongan berhasil ditambahkan.');
    }

    public function updateJob(Request $request, BkkJobVacancy $job)
    {
        $job->update($this->validateJob($request));

        return $this->back('lowongan', 'Lowongan berhasil diperbarui.');
    }

    public function destroyJob(BkkJobVacancy $job)
    {
        $job->delete();

        return $this->back('lowongan', 'Lowongan berhasil dihapus.');
    }

    public function toggleJob(BkkJobVacancy $job)
    {
        $job->update(['is_active' => !$job->is_active]);

        return $this->back('lowongan', $job->is_active ? 'Lowongan ditampilkan.' : 'Lowongan disembunyikan dari halaman publik.');
    }

    /** Ganti status cepat dari dropdown di daftar. */
    public function statusJob(Request $request, BkkJobVacancy $job)
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(BkkJobVacancy::STATUSES))],
        ]);

        $job->update(['status' => $data['status']]);

        return $this->back('lowongan', 'Status lowongan diubah ke ' . $data['status'] . '.');
    }

    /* ===================== MITRA INDUSTRI ===================== */

    public function storeIndustry(Request $request)
    {
        $data = $this->validateIndustry($request);
        $data['order'] = ((int) BkkIndustry::max('order')) + 1;
        BkkIndustry::create($data);

        return $this->back('industri', 'Mitra industri berhasil ditambahkan.');
    }

    public function updateIndustry(Request $request, BkkIndustry $industry)
    {
        $industry->update($this->validateIndustry($request));

        return $this->back('industri', 'Mitra industri berhasil diperbarui.');
    }

    public function destroyIndustry(BkkIndustry $industry)
    {
        $industry->delete();

        return $this->back('industri', 'Mitra industri berhasil dihapus.');
    }

    public function toggleIndustry(BkkIndustry $industry)
    {
        $industry->update(['is_active' => !$industry->is_active]);

        return $this->back('industri', $industry->is_active ? 'Mitra ditampilkan.' : 'Mitra disembunyikan dari halaman publik.');
    }

    public function moveIndustry(BkkIndustry $industry, string $direction)
    {
        $list = BkkIndustry::ordered()->get()->values();
        $i = $list->search(fn ($x) => $x->id === $industry->id);
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

        return redirect()->route('admin.bkk.index', ['tab' => 'industri']);
    }

    /* ===================== HELPERS ===================== */

    private function validateJob(Request $request): array
    {
        $data = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'company_name'    => ['required', 'string', 'max:255'],
            'location'        => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:60'],
            'status'          => ['required', 'in:' . implode(',', array_keys(BkkJobVacancy::STATUSES))],
            'deadline'        => ['nullable', 'date'],
            'apply_url'       => ['nullable', 'string', 'max:500', 'regex:/^(https?:\/\/|mailto:).+/i'],
            'description'     => ['nullable', 'string', 'max:3000'],
            'is_active'       => ['nullable', 'boolean'],
        ], [
            'apply_url.regex' => 'Link lamaran harus diawali http://, https:// atau mailto:.',
            'deadline.date'   => 'Batas pendaftaran harus berupa tanggal yang valid.',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function validateIndustry(Request $request): array
    {
        $data = $request->validate([
            'company_name'      => ['required', 'string', 'max:150'],
            'field_of_work'     => ['nullable', 'string', 'max:120'],
            'partnership_scope' => ['nullable', 'string', 'max:200'],
            'is_active'         => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function deletePhoto(?string $path): void
    {
        if (BkkSetting::isUploaded($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function back(string $tab, string $message)
    {
        return redirect()->route('admin.bkk.index', ['tab' => $tab])->with('status', $message);
    }
}
