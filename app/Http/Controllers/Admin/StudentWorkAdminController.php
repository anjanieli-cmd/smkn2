<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentWork;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentWorkAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = StudentWork::with('major');

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('major_id') && $request->input('major_id') !== '') {
            $query->where('major_id', $request->input('major_id'));
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(15);

        return ApiResponse::success($items, 'Data karya siswa / produk PKK berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'student_name' => ['required', 'string', 'max:255'],
            'major_id' => ['required', 'string', 'exists:majors,id'],
            'description' => ['required', 'string'],
            'media_url' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $validated['status'] = $validated['status'] ?? 'APPROVED';

        $work = StudentWork::create($validated);

        return ApiResponse::success($work->load('major'), 'Karya siswa baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $work = StudentWork::with('major')->find($id);

        if (! $work) {
            return ApiResponse::error('Karya siswa tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($work, 'Detail karya siswa berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $work = StudentWork::find($id);

        if (! $work) {
            return ApiResponse::error('Karya siswa tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'student_name' => ['sometimes', 'required', 'string', 'max:255'],
            'major_id' => ['sometimes', 'required', 'string', 'exists:majors,id'],
            'description' => ['sometimes', 'required', 'string'],
            'media_url' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $work->update($validated);

        return ApiResponse::success($work->load('major'), 'Data karya siswa berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $work = StudentWork::find($id);

        if (! $work) {
            return ApiResponse::error('Karya siswa tidak ditemukan.', null, 404);
        }

        $work->delete();

        return ApiResponse::success(null, 'Karya siswa berhasil dihapus.');
    }
}
