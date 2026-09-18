<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\FactCheck;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FactCheckController extends Controller
{
    /**
     * Get published FactCheck items.
     */
    public function index(Request $request): JsonResponse
    {
        $query = FactCheck::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('claim', 'like', "%{$search}%");
            });
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->orderBy('published_at', 'desc')->paginate(10);

        return ApiResponse::success($items, 'Data FactCheck berhasil diambil.');
    }

    /**
     * Show FactCheck detail.
     */
    public function show(string $id): JsonResponse
    {
        $item = FactCheck::query()->find($id);

        if (! $item) {
            return ApiResponse::error('Klarifikasi informasi tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($item, 'Detail FactCheck berhasil diambil.');
    }

    /**
     * Submit a hoaks link report for admin review.
     */
    public function report(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'link' => ['required', 'url'],
            'kategori' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $item = FactCheck::create([
            'title' => $validated['catatan'] ?: 'Laporan Link Klarifikasi Baru',
            'claim' => $validated['catatan'] ?: ('Laporan link baru: ' . $validated['link']),
            'verdict_explanation' => 'Laporan ini baru saja dikirim dan sedang ditelusuri oleh tim admin sekolah.',
            'status' => \App\Enums\FactCheckStatus::UNCONFIRMED,
            'source_url' => $validated['link'],
            'published_at' => now(),
        ]);

        return ApiResponse::success($item, 'Laporan dugaan hoaks berhasil dikirim dan menunggu verifikasi admin.', null, 201);
    }
}
