<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryAdminController extends Controller
{
    public function index(Request $request): View
    {
        \Database\Seeders\GallerySeeder::seedIfEmpty();

        $query = Gallery::withCount('photos')->with('photos');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $albums = $query->orderBy('created_at', 'desc')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('admin.galleries.index', compact('albums'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'event_date'  => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'photos'      => ['nullable', 'array'],
            'photos.*'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        $imageUrl = 'images/galeri/adiwiyata.jpeg';

        $uploadDir = public_path('images/galeri');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $imageUrl = 'images/galeri/' . $filename;
        }

        $gallery = Gallery::create([
            'title'       => $validated['title'],
            'category'    => $validated['category'] ?? 'Kegiatan Sekolah',
            'description' => $validated['description'] ?? null,
            'event_date'  => $validated['event_date'] ?? null,
            'image_url'   => $imageUrl,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $photoName = time() . '_' . $index . '_' . Str::slug(pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photoFile->getClientOriginalExtension();
                    $photoFile->move(public_path('images/galeri'), $photoName);
                    
                    GalleryPhoto::create([
                        'gallery_id' => $gallery->id,
                        'photo_url'  => 'images/galeri/' . $photoName,
                        'caption'    => $gallery->title,
                        'order'      => $index,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Album kegiatan "' . $gallery->title . '" berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'event_date'  => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($gallery->image_url && file_exists(public_path($gallery->image_url)) && !Str::startsWith($gallery->image_url, 'images/logo')) {
                @unlink(public_path($gallery->image_url));
            }

            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/galeri'), $filename);
            $validated['image_url'] = 'images/galeri/' . $filename;
        }

        $gallery->update([
            'title'       => $validated['title'],
            'category'    => $validated['category'],
            'event_date'  => $validated['event_date'] ?? $gallery->event_date,
            'description' => $validated['description'] ?? null,
            'image_url'   => $validated['image_url'] ?? $gallery->image_url,
        ]);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Album kegiatan "' . $gallery->title . '" berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $gallery = Gallery::with('photos')->findOrFail($id);
        $title = $gallery->title;

        if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
            @unlink(public_path($gallery->image_url));
        }

        foreach ($gallery->photos as $photo) {
            if ($photo->photo_url && file_exists(public_path($photo->photo_url))) {
                @unlink(public_path($photo->photo_url));
            }
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Album "' . $title . '" beserta seluruh fotonya berhasil dihapus.');
    }

    public function uploadPhotos(Request $request, string $id): RedirectResponse
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'photos'   => ['required', 'array'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        $uploadedCount = 0;
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $photoName = time() . '_' . $index . '_' . Str::slug(pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $photoFile->getClientOriginalExtension();
                    $photoFile->move(public_path('images/galeri'), $photoName);

                    GalleryPhoto::create([
                        'gallery_id' => $gallery->id,
                        'photo_url'  => 'images/galeri/' . $photoName,
                        'caption'    => $gallery->title,
                        'order'      => $gallery->photos()->count() + $index,
                    ]);
                    $uploadedCount++;
                }
            }
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', $uploadedCount . ' foto baru berhasil diunggah ke album "' . $gallery->title . '".');
    }

    public function deletePhoto(string $photoId): RedirectResponse
    {
        $photo = GalleryPhoto::findOrFail($photoId);

        if ($photo->photo_url && file_exists(public_path($photo->photo_url))) {
            @unlink(public_path($photo->photo_url));
        }

        $photo->delete();

        return redirect()
            ->back()
            ->with('success', 'Foto berhasil dihapus dari album.');
    }
}
