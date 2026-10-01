<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /** Folder tujuan upload (langsung di public/, sama seperti modul Guru & Staf). */
    private const DIR = 'images/partners';

    /** Hanya file hasil upload lewat admin yang boleh dihapus otomatis (logo bawaan aman). */
    private const UPLOAD_PREFIX = 'upload_';

    public function index(): View
    {
        $items = Partner::orderBy('order')->get()->each->append('logo_url');

        return view('admin.partners.index', compact('items'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'items'                => ['nullable', 'array'],
            'items.*.name'         => ['nullable', 'string', 'max:255'],
            'items.*.url'          => ['nullable', 'string', 'max:255'],
            'items.*.is_active'    => ['nullable', 'boolean'],
            'items.*.logo'         => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'],
            'items.*.existing_logo' => ['nullable', 'string', 'max:255'],
        ]);

        $oldLogos = Partner::pluck('logo')->all();

        DB::transaction(function () use ($request) {
            Partner::query()->delete();

            $order = 0;
            foreach ($request->input('items', []) as $i => $row) {
                $logoPath = $row['existing_logo'] ?? null;

                if ($request->hasFile("items.$i.logo")) {
                    $logoPath = $this->storeLogo($request->file("items.$i.logo"));
                }

                // Tanpa logo => baris dilewati (nama saja tidak cukup untuk ditampilkan)
                if (blank($logoPath)) {
                    continue;
                }

                Partner::create([
                    'name'      => filled($row['name'] ?? null) ? trim($row['name']) : 'Partner',
                    'logo'      => $logoPath,
                    'url'       => filled($row['url'] ?? null) ? trim($row['url']) : null,
                    'is_active' => (bool) ($row['is_active'] ?? false),
                    'order'     => $order++,
                ]);
            }
        });

        // Bersihkan file logo hasil upload yang sudah tidak dipakai
        $kept = Partner::pluck('logo')->all();
        foreach ($oldLogos as $old) {
            if ($old && !in_array($old, $kept, true) && str_starts_with(basename($old), self::UPLOAD_PREFIX)) {
                $full = public_path($old);
                if (is_file($full)) {
                    @unlink($full);
                }
            }
        }

        return redirect()
            ->route('admin.partners.index')
            ->with('status', 'Logo Partner / Mitra berhasil disimpan.');
    }

    private function storeLogo($file): string
    {
        $dir = public_path(self::DIR);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $filename = self::UPLOAD_PREFIX . time() . '_' . $safeName;
        $file->move($dir, $filename);

        return self::DIR . '/' . $filename;
    }
}
