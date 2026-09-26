<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherStaff;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherStaffAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = TeacherStaff::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('role_position', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('name', 'asc')->paginate(15);

        return ApiResponse::success($items, 'Data guru & tenaga kependidikan berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:100'],
            'role_position' => ['required', 'string', 'max:255'],
            'photo_url' => ['nullable', 'string', 'max:500'],
            'photo_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5012'],
            'is_active' => ['nullable'],
        ]);

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('images/guru');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['photo_url'] = 'images/guru/' . $filename;
        }

        $validated['is_active'] = isset($validated['is_active']) ? filter_var($validated['is_active'], FILTER_VALIDATE_BOOLEAN) : true;

        $teacher = TeacherStaff::create($validated);

        return ApiResponse::success($teacher, 'Data guru/tendik baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $teacher = TeacherStaff::find($id);

        if (! $teacher) {
            return ApiResponse::error('Data guru/tendik tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($teacher, 'Detail guru/tendik berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $teacher = TeacherStaff::find($id);

        if (! $teacher) {
            return ApiResponse::error('Data guru/tendik tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:100'],
            'role_position' => ['sometimes', 'required', 'string', 'max:255'],
            'photo_url' => ['nullable', 'string', 'max:500'],
            'photo_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5012'],
            'is_active' => ['nullable'],
        ]);

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('images/guru');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['photo_url'] = 'images/guru/' . $filename;
        }

        if (isset($validated['is_active'])) {
            $validated['is_active'] = filter_var($validated['is_active'], FILTER_VALIDATE_BOOLEAN);
        }

        $teacher->update($validated);

        return ApiResponse::success($teacher, 'Data guru/tendik berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $teacher = TeacherStaff::find($id);

        if (! $teacher) {
            return ApiResponse::error('Data guru/tendik tidak ditemukan.', null, 404);
        }

        $teacher->delete();

        return ApiResponse::success(null, 'Data guru/tendik berhasil dihapus.');
    }
}
