<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MajorAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Major::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('name', 'asc')->get();

        return ApiResponse::success($items, 'Daftar konsentrasi keahlian/jurusan berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:majors,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon_url' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $validated['is_active'] ?? true;

        $major = Major::create($validated);

        return ApiResponse::success($major, 'Jurusan baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $major = Major::with(['alumni', 'studentWorks'])->find($id);

        if (! $major) {
            return ApiResponse::error('Jurusan tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($major, 'Detail jurusan berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $major = Major::find($id);

        if (! $major) {
            return ApiResponse::error('Jurusan tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'code' => ['sometimes', 'required', 'string', 'max:50', 'unique:majors,code,' . $id],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon_url' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (isset($validated['name']) && $validated['name'] !== $major->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $major->update($validated);

        return ApiResponse::success($major, 'Data jurusan berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $major = Major::find($id);

        if (! $major) {
            return ApiResponse::error('Jurusan tidak ditemukan.', null, 404);
        }

        $major->delete();

        return ApiResponse::success(null, 'Jurusan berhasil dihapus.');
    }
}
