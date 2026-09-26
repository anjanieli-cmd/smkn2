<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = NewsArticle::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->input('status') !== '' && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(15);

        return ApiResponse::success($items, 'Data berita & pengumuman berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'author_name' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'in:DRAFT,PUBLISHED,ARCHIVED'],
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['status'] = $validated['status'] ?? 'PUBLISHED';
        $validated['published_at'] = now();

        $article = NewsArticle::create($validated);

        return ApiResponse::success($article, 'Berita baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $article = NewsArticle::find($id);

        if (! $article) {
            return ApiResponse::error('Berita tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($article, 'Detail berita berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $article = NewsArticle::find($id);

        if (! $article) {
            return ApiResponse::error('Berita tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['sometimes', 'required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'author_name' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'in:DRAFT,PUBLISHED,ARCHIVED'],
        ]);

        if (isset($validated['title']) && $validated['title'] !== $article->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        }

        $article->update($validated);

        return ApiResponse::success($article, 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $article = NewsArticle::find($id);

        if (! $article) {
            return ApiResponse::error('Berita tidak ditemukan.', null, 404);
        }

        $article->delete();

        return ApiResponse::success(null, 'Berita berhasil dihapus.');
    }
}
