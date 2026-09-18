<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ExtracurricularController extends Controller
{
    /**
     * Get active extracurriculars list.
     */
    public function index(): JsonResponse
    {
        $ekskul = Cache::remember('extracurriculars.active', 86400, function () {
            return Extracurricular::query()
                ->where('is_active', true)
                ->get();
        });

        return ApiResponse::success($ekskul, 'Daftar ekstrakurikuler berhasil diambil.');
    }

    /**
     * Show extracurricular detail.
     */
    public function show(string $identifier): JsonResponse
    {
        $item = Extracurricular::query()
            ->where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->first();

        if (! $item) {
            return ApiResponse::error('Ekstrakurikuler tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($item, 'Detail ekstrakurikuler berhasil diambil.');
    }
}
