<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Database\Seeders\MajorSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MajorAdminController extends Controller
{
    public function index(Request $request): View
    {
        MajorSeeder::seedIfEmpty();

        $query = Major::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('is_active', $request->boolean('status'));
        }

        $items = $query->orderBy('code', 'asc')->get();

        $stats = [
            'total' => Major::count(),
            'active' => Major::where('is_active', true)->count(),
            'inactive' => Major::where('is_active', false)->count(),
        ];

        return view('admin.majors.index', compact('items', 'stats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code'        => ['required', 'string', 'max:20', 'unique:majors,code'],
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255'],
            'icon_url'    => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['nullable', 'boolean'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $iconUrl = $validated['icon_url'] ?? 'fas fa-graduation-cap';

        if ($request->hasFile('image')) {
            $uploadDir = public_path('images/jurusan');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['code']) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $iconUrl = 'images/jurusan/' . $filename;
        }

        $details = [];
        if ($request->has('hero_subtitle')) $details['hero_subtitle'] = $request->input('hero_subtitle');
        if ($request->has('video_url'))     $details['video_url']     = $request->input('video_url');
        if ($request->has('kakomli_name'))  $details['kakomli_name']  = $request->input('kakomli_name');
        if ($request->has('kakomli_role'))  $details['kakomli_role']  = $request->input('kakomli_role');
        if ($request->has('kakomli_quote')) $details['kakomli_quote'] = $request->input('kakomli_quote');

        if ($request->has('competencies') && is_array($request->input('competencies'))) {
            $details['competencies'] = array_values(array_filter($request->input('competencies'), fn($c) => !empty($c['title'])));
        }
        if ($request->has('facilities') && is_array($request->input('facilities'))) {
            $details['facilities'] = array_values(array_filter($request->input('facilities'), fn($f) => !empty($f['title'])));
        }
        if ($request->has('careers') && is_array($request->input('careers'))) {
            $details['careers'] = array_values(array_filter($request->input('careers'), fn($cr) => !empty($cr['title'])));
        }

        $major = Major::create([
            'code'        => strtoupper(trim($validated['code'])),
            'name'        => trim($validated['name']),
            'slug'        => $slug,
            'icon_url'    => $iconUrl,
            'description' => $validated['description'] ?? null,
            'is_active'   => $request->has('is_active') ? $request->boolean('is_active') : true,
            'details'     => $details,
        ]);

        return redirect()
            ->route('admin.majors.index')
            ->with('success', 'Program Keahlian baru "' . $major->name . '" (' . $major->code . ') berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $major = Major::findOrFail($id);

        $validated = $request->validate([
            'code'        => ['required', 'string', 'max:20', 'unique:majors,code,' . $major->id],
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255'],
            'icon_url'    => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['nullable', 'boolean'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:10240'],
            'video_file'  => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:102400'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $iconUrl = $validated['icon_url'] ?? $major->icon_url;

        if ($request->hasFile('image')) {
            if ($major->icon_url && file_exists(public_path($major->icon_url)) && Str::startsWith($major->icon_url, 'images/jurusan/')) {
                @unlink(public_path($major->icon_url));
            }

            $uploadDir = public_path('images/jurusan');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['code']) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $iconUrl = 'images/jurusan/' . $filename;
        }

        $details = $major->details ?? [];
        if ($request->has('hero_subtitle')) $details['hero_subtitle'] = $request->input('hero_subtitle');
        
        // Handle Video URL / Video File upload
        if ($request->hasFile('video_file')) {
            $videoDir = public_path('images/videos');
            if (!file_exists($videoDir)) {
                mkdir($videoDir, 0755, true);
            }
            $vFile = $request->file('video_file');
            $vFilename = 'video_' . Str::slug($validated['code']) . '_' . time() . '.' . $vFile->getClientOriginalExtension();
            $vFile->move($videoDir, $vFilename);
            $details['video_url'] = 'images/videos/' . $vFilename;
        } elseif ($request->has('video_url')) {
            $details['video_url'] = $request->input('video_url');
        }

        if ($request->has('video_title'))  $details['video_title']  = $request->input('video_title');
        if ($request->has('video_desc'))   $details['video_desc']   = $request->input('video_desc');
        if ($request->has('about_lead'))   $details['about_lead']   = $request->input('about_lead');
        if ($request->has('about_sub'))    $details['about_sub']    = $request->input('about_sub');
        if ($request->has('kakomli_name'))  $details['kakomli_name']  = $request->input('kakomli_name');
        if ($request->has('kakomli_role'))  $details['kakomli_role']  = $request->input('kakomli_role');
        if ($request->has('kakomli_quote')) $details['kakomli_quote'] = $request->input('kakomli_quote');
        if ($request->has('cta_title'))    $details['cta_title']    = $request->input('cta_title');
        if ($request->has('cta_desc'))     $details['cta_desc']     = $request->input('cta_desc');

        if ($request->has('competencies') && is_array($request->input('competencies'))) {
            $details['competencies'] = array_values(array_filter($request->input('competencies'), fn($c) => !empty($c['title'])));
        }
        if ($request->has('facilities') && is_array($request->input('facilities'))) {
            $details['facilities'] = array_values(array_filter($request->input('facilities'), fn($f) => !empty($f['title'])));
        }
        if ($request->has('careers') && is_array($request->input('careers'))) {
            $details['careers'] = array_values(array_filter($request->input('careers'), fn($cr) => !empty($cr['title'])));
        }

        $major->update([
            'code'        => strtoupper(trim($validated['code'])),
            'name'        => trim($validated['name']),
            'slug'        => $slug,
            'icon_url'    => $iconUrl,
            'description' => $validated['description'] ?? null,
            'is_active'   => $request->has('is_active') ? $request->boolean('is_active') : false,
            'details'     => $details,
        ]);

        return redirect()
            ->route('admin.majors.index')
            ->with('success', 'Data Program Keahlian "' . $major->name . '" berhasil diperbarui.');
    }

    public function toggle(string $id): RedirectResponse
    {
        $major = Major::findOrFail($id);
        $major->is_active = !$major->is_active;
        $major->save();

        $statusText = $major->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->route('admin.majors.index')
            ->with('success', 'Status Program Keahlian "' . $major->name . '" berhasil ' . $statusText . '.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $major = Major::findOrFail($id);
        $name = $major->name;

        // Check for related student works or alumni if needed
        if ($major->studentWorks()->count() > 0 || $major->alumni()->count() > 0) {
            return redirect()
                ->route('admin.majors.index')
                ->with('error', 'Program Keahlian "' . $name . '" tidak dapat dihapus karena masih terhubung dengan data Karya Siswa / Alumni.');
        }

        if ($major->icon_url && file_exists(public_path($major->icon_url)) && Str::startsWith($major->icon_url, 'images/jurusan/')) {
            @unlink(public_path($major->icon_url));
        }

        $major->delete();

        return redirect()
            ->route('admin.majors.index')
            ->with('success', 'Program Keahlian "' . $name . '" berhasil dihapus.');
    }
}
