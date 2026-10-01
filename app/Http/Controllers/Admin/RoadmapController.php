<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoadmapPhase;
use App\Models\RoadmapPillar;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoadmapController extends Controller
{
    private const SETTING_KEYS = [
        'roadmap_intro_copy',
        'roadmap_stat1_value', 'roadmap_stat1_label',
        'roadmap_stat2_value', 'roadmap_stat2_label',
        'roadmap_stat3_value', 'roadmap_stat3_label',
        'roadmap_stat4_value', 'roadmap_stat4_label',
    ];

    public function index(): View
    {
        $settings = SiteSetting::many(self::SETTING_KEYS);
        $pillars  = RoadmapPillar::orderBy('order')->get();
        $phases   = RoadmapPhase::orderBy('order')->get();

        return view('admin.roadmap.index', compact('settings', 'pillars', 'phases'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'roadmap_intro_copy'  => ['nullable', 'string', 'max:2000'],
            'roadmap_stat1_value' => ['nullable', 'string', 'max:20'],
            'roadmap_stat1_label' => ['nullable', 'string', 'max:60'],
            'roadmap_stat2_value' => ['nullable', 'string', 'max:20'],
            'roadmap_stat2_label' => ['nullable', 'string', 'max:60'],
            'roadmap_stat3_value' => ['nullable', 'string', 'max:20'],
            'roadmap_stat3_label' => ['nullable', 'string', 'max:60'],
            'roadmap_stat4_value' => ['nullable', 'string', 'max:20'],
            'roadmap_stat4_label' => ['nullable', 'string', 'max:60'],

            'pillars'         => ['nullable', 'array'],
            'pillars.*.icon'  => ['nullable', 'string', 'max:60'],
            'pillars.*.title' => ['nullable', 'string', 'max:255'],
            'pillars.*.text'  => ['nullable', 'string'],

            'phases'           => ['nullable', 'array'],
            'phases.*.year'    => ['nullable', 'string', 'max:20'],
            'phases.*.icon'    => ['nullable', 'string', 'max:60'],
            'phases.*.title'   => ['nullable', 'string', 'max:255'],
            'phases.*.text'    => ['nullable', 'string'],
            'phases.*.items'   => ['nullable', 'string'],
            'phases.*.tag'     => ['nullable', 'string', 'max:60'],
            'phases.*.is_goal' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($request) {
            // ---- Intro + statistik ----
            $settings = [];
            foreach (self::SETTING_KEYS as $key) {
                $settings[$key] = (string) $request->input($key, '');
            }
            SiteSetting::setMany($settings);

            // ---- Pilar ----
            RoadmapPillar::query()->delete();
            $order = 0;
            foreach ($request->input('pillars', []) as $row) {
                if (blank($row['title'] ?? null)) {
                    continue;
                }
                RoadmapPillar::create([
                    'icon'  => $this->cleanIcon($row['icon'] ?? null, 'fa-star'),
                    'title' => trim($row['title']),
                    'text'  => $row['text'] ?? null,
                    'order' => $order++,
                ]);
            }

            // ---- Fase ----
            RoadmapPhase::query()->delete();
            $order = 0;
            foreach ($request->input('phases', []) as $row) {
                if (blank($row['title'] ?? null)) {
                    continue;
                }

                // Poin program: satu baris textarea = satu poin
                $items = array_values(array_filter(array_map(
                    'trim',
                    preg_split('/\R/', (string) ($row['items'] ?? ''))
                ), fn ($line) => $line !== ''));

                RoadmapPhase::create([
                    'year'    => trim((string) ($row['year'] ?? '')),
                    'icon'    => $this->cleanIcon($row['icon'] ?? null, 'fa-flag'),
                    'title'   => trim($row['title']),
                    'text'    => $row['text'] ?? null,
                    'items'   => $items,
                    'tag'     => filled($row['tag'] ?? null) ? trim($row['tag']) : null,
                    'is_goal' => (bool) ($row['is_goal'] ?? false),
                    'order'   => $order++,
                ]);
            }
        });

        return redirect()
            ->route('admin.roadmap.index')
            ->with('status', 'Roadmap Pengembangan berhasil disimpan.');
    }

    private function cleanIcon(?string $icon, string $fallback): string
    {
        $icon = trim((string) $icon);
        if ($icon === '') {
            return $fallback;
        }
        $parts = preg_split('/\s+/', $icon);
        $name  = end($parts);

        return str_starts_with($name, 'fa-') ? $name : 'fa-' . $name;
    }
}
