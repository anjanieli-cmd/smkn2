<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = NewsArticle::query()
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return ApiResponse::success($articles, 'Daftar berita berhasil diambil.');
    }

    public function show(string $identifier): JsonResponse
    {
        $article = NewsArticle::query()
            ->where('status', 'PUBLISHED')
            ->where(function ($q) use ($identifier) {
                $q->where('id', $identifier)->orWhere('slug', $identifier);
            })
            ->first();

        if (! $article) {
            return ApiResponse::error('Berita tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($article, 'Detail berita berhasil diambil.');
    }
}
