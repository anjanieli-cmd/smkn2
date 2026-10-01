<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /** Halaman tunggal: daftar pengumuman (repeater) langsung tampil sebagai form. */
    public function index(): View
    {
        $items = Announcement::orderBy('order')->get();

        return view('admin.announcement.index', compact('items'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'items'             => ['nullable', 'array'],
            'items.*.icon'      => ['nullable', 'string', 'max:60'],
            'items.*.text'      => ['nullable', 'string', 'max:255'],
            'items.*.url'       => ['nullable', 'string', 'max:255'],
            'items.*.is_active' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($request) {
            Announcement::query()->delete();

            $order = 0;
            foreach ($request->input('items', []) as $row) {
                if (blank($row['text'] ?? null)) {
                    continue; // baris kosong dilewati
                }

                Announcement::create([
                    'icon'      => $this->cleanIcon($row['icon'] ?? null),
                    'text'      => trim($row['text']),
                    'url'       => filled($row['url'] ?? null) ? trim($row['url']) : null,
                    'is_active' => (bool) ($row['is_active'] ?? false),
                    'order'     => $order++,
                ]);
            }
        });

        return redirect()
            ->route('admin.announcement.index')
            ->with('status', 'Announcement Bar berhasil disimpan.');
    }

    /** Terima "fa-bullhorn", "bullhorn", atau "fas fa-bullhorn" => selalu jadi "fa-bullhorn". */
    private function cleanIcon(?string $icon): string
    {
        $icon = trim((string) $icon);
        if ($icon === '') {
            return 'fa-bullhorn';
        }
        $parts = preg_split('/\s+/', $icon);
        $name  = end($parts);

        return str_starts_with($name, 'fa-') ? $name : 'fa-' . $name;
    }
}
