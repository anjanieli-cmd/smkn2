<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtracurricularAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Extracurricular::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('coach_name', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('name', 'asc')->get();

        return ApiResponse::success($items, 'Daftar ekstrakurikuler berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'coach_name' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'attributes' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $validated['is_active'] ?? true;

        $extra = Extracurricular::create($validated);

        return ApiResponse::success($extra, 'Ekstrakurikuler baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $extra = Extracurricular::find($id);

        if (! $extra) {
            return ApiResponse::error('Ekstrakurikuler tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($extra, 'Detail ekstrakurikuler berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $extra = Extracurricular::find($id);

        if (! $extra) {
            return ApiResponse::error('Ekstrakurikuler tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'coach_name' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'attributes' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (isset($validated['name']) && $validated['name'] !== $extra->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $extra->update($validated);

        return ApiResponse::success($extra, 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $extra = Extracurricular::find($id);

        if (! $extra) {
            return ApiResponse::error('Ekstrakurikuler tidak ditemukan.', null, 404);
        }

        $extra->delete();

        return ApiResponse::success(null, 'Ekstrakurikuler berhasil dihapus.');
    }
}
