<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobVacancyAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = JobVacancy::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(15);

        return ApiResponse::success($items, 'Data lowongan kerja BKK berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'apply_url' => ['nullable', 'string', 'max:500'],
            'deadline' => ['nullable', 'date'],
            'status' => ['nullable', 'string', 'in:OPEN,CLOSED'],
        ]);

        $validated['status'] = $validated['status'] ?? 'OPEN';

        $job = JobVacancy::create($validated);

        return ApiResponse::success($job, 'Lowongan kerja baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $job = JobVacancy::find($id);

        if (! $job) {
            return ApiResponse::error('Lowongan kerja tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($job, 'Detail lowongan kerja berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $job = JobVacancy::find($id);

        if (! $job) {
            return ApiResponse::error('Lowongan kerja tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'company_name' => ['sometimes', 'required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'apply_url' => ['nullable', 'string', 'max:500'],
            'deadline' => ['nullable', 'date'],
            'status' => ['nullable', 'string', 'in:OPEN,CLOSED'],
        ]);

        $job->update($validated);

        return ApiResponse::success($job, 'Lowongan kerja berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $job = JobVacancy::find($id);

        if (! $job) {
            return ApiResponse::error('Lowongan kerja tidak ditemukan.', null, 404);
        }

        $job->delete();

        return ApiResponse::success(null, 'Lowongan kerja berhasil dihapus.');
    }
}
