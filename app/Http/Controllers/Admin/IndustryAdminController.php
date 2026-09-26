<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndustryPartnership;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndustryAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = IndustryPartnership::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('field_of_work', 'like', "%{$search}%")
                  ->orWhere('partnership_scope', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('company_name', 'asc')->paginate(15);

        return ApiResponse::success($items, 'Data mitra industri (DUDI) berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'string', 'max:500'],
            'field_of_work' => ['nullable', 'string', 'max:255'],
            'partnership_scope' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $validated['is_active'] ?? true;

        $partner = IndustryPartnership::create($validated);

        return ApiResponse::success($partner, 'Mitra industri baru berhasil ditambahkan.', null, 201);
    }

    public function show(string $id): JsonResponse
    {
        $partner = IndustryPartnership::find($id);

        if (! $partner) {
            return ApiResponse::error('Mitra industri tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($partner, 'Detail mitra industri berhasil diambil.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $partner = IndustryPartnership::find($id);

        if (! $partner) {
            return ApiResponse::error('Mitra industri tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'company_name' => ['sometimes', 'required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'string', 'max:500'],
            'field_of_work' => ['nullable', 'string', 'max:255'],
            'partnership_scope' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $partner->update($validated);

        return ApiResponse::success($partner, 'Data mitra industri berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $partner = IndustryPartnership::find($id);

        if (! $partner) {
            return ApiResponse::error('Mitra industri tidak ditemukan.', null, 404);
        }

        $partner->delete();

        return ApiResponse::success(null, 'Data mitra industri berhasil dihapus.');
    }
}
