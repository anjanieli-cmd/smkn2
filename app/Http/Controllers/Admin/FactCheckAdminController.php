<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FactCheck;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FactCheckAdminController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'claim' => ['required', 'string'],
            'verdict_explanation' => ['required', 'string'],
            'status' => ['required', 'string'],
            'source_url' => ['nullable', 'url'],
        ]);

        $validated['published_at'] = now();
        $item = FactCheck::create($validated);

        return ApiResponse::success($item, 'FactCheck berhasil dipublikasikan.', null, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = FactCheck::query()->find($id);

        if (! $item) {
            return ApiResponse::error('FactCheck tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'claim' => ['sometimes', 'string'],
            'verdict_explanation' => ['sometimes', 'string'],
            'status' => ['sometimes', 'string'],
            'source_url' => ['nullable', 'url'],
        ]);

        $item->update($validated);

        return ApiResponse::success($item, 'FactCheck berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $item = FactCheck::query()->find($id);

        if (! $item) {
            return ApiResponse::error('FactCheck tidak ditemukan.', null, 404);
        }

        $item->delete();

        return ApiResponse::success(null, 'FactCheck berhasil dihapus.');
    }
}
