<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class MajorController extends Controller
{
    /**
     * Get list of majors (Keahlian) for SMKN 2 Mojokerto.
     */
    public function index(): JsonResponse
    {
        $majors = Cache::remember('school.majors.active', 86400, function () {
            return Major::query()
                ->where('is_active', true)
                ->get();
        });

        return ApiResponse::success($majors, 'Daftar keahlian jurusan berhasil diambil.');
    }

    /**
     * Get major detail by ID or slug.
     */
    public function show(string $identifier): JsonResponse
    {
        $major = Major::query()
            ->where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->where('is_active', true)
            ->first();

        if (! $major) {
            return ApiResponse::error('Jurusan tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($major, 'Detail jurusan berhasil diambil.');
    }
}
