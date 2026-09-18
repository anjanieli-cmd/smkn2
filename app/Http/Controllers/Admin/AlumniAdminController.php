<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AlumniAdminController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'graduation_year' => ['required', 'integer'],
            'major_id' => ['nullable', 'uuid'],
            'status' => ['nullable', 'string'],
            'university' => ['nullable', 'string'],
            'company' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'publication_status' => ['nullable', 'string'],
        ]);

        $alumni = Alumni::create($validated);
        Cache::forget('alumni.map.aggregated');

        return ApiResponse::success($alumni, 'Data alumni berhasil ditambahkan.', null, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $alumni = Alumni::query()->find($id);

        if (! $alumni) {
            return ApiResponse::error('Data alumni tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'graduation_year' => ['sometimes', 'integer'],
            'major_id' => ['nullable', 'uuid'],
            'status' => ['nullable', 'string'],
            'university' => ['nullable', 'string'],
            'company' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'publication_status' => ['nullable', 'string'],
        ]);

        $alumni->update($validated);
        Cache::forget('alumni.map.aggregated');

        return ApiResponse::success($alumni, 'Data alumni berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $alumni = Alumni::query()->find($id);

        if (! $alumni) {
            return ApiResponse::error('Data alumni tidak ditemukan.', null, 404);
        }

        $alumni->delete();
        Cache::forget('alumni.map.aggregated');

        return ApiResponse::success(null, 'Data alumni berhasil dihapus.');
    }
}
