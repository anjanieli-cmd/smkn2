<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolAchievement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AchievementAdminController extends Controller
{
    public function index(Request $request): View
    {
        \Database\Seeders\AchievementSeeder::seedIfEmpty();

        $query = SchoolAchievement::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('winner_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->input('level'));
        }

        $items = $query->orderBy('created_at', 'desc')
            ->orderBy('year', 'desc')
            ->get();

        return view('admin.achievements.index', compact('items'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'level'       => ['required', 'string', 'max:100'],
            'year'        => ['required', 'string', 'max:10'],
            'winner_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        $imageUrl = 'images/prestasi/lks-web.jpg';

        $uploadDir = public_path('images/prestasi');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $imageUrl = 'images/prestasi/' . $filename;
        }

        $achievement = SchoolAchievement::create([
            'title'       => $validated['title'],
            'level'       => $validated['level'] ?? 'Provinsi',
            'year'        => $validated['year'] ?? date('Y'),
            'winner_name' => $validated['winner_name'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_url'   => $imageUrl,
        ]);

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Prestasi baru "' . $achievement->title . '" berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $achievement = SchoolAchievement::findOrFail($id);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'level'       => ['required', 'string', 'max:100'],
            'year'        => ['required', 'string', 'max:10'],
            'winner_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            if ($achievement->image_url && file_exists(public_path($achievement->image_url)) && !Str::startsWith($achievement->image_url, 'images/logo')) {
                @unlink(public_path($achievement->image_url));
            }

            $uploadDir = public_path('images/prestasi');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image_url'] = 'images/prestasi/' . $filename;
        }

        $achievement->update([
            'title'       => $validated['title'],
            'level'       => $validated['level'],
            'year'        => $validated['year'],
            'winner_name' => $validated['winner_name'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_url'   => $validated['image_url'] ?? $achievement->image_url,
        ]);

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Data prestasi "' . $achievement->title . '" berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $achievement = SchoolAchievement::findOrFail($id);
        $title = $achievement->title;

        if ($achievement->image_url && file_exists(public_path($achievement->image_url))) {
            @unlink(public_path($achievement->image_url));
        }

        $achievement->delete();

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Data prestasi "' . $title . '" berhasil dihapus.');
    }
}
