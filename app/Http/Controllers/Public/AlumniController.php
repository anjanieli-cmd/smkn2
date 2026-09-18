<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Services\Alumni\AlumniService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function __construct(
        private AlumniService $alumniService
    ) {}

    /**
     * Get paginated alumni directory with filters.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Alumni::query()
            ->where('publication_status', 'PUBLISHED')
            ->with('major:id,code,name');

        if ($request->has('year')) {
            $query->where('graduation_year', $request->input('year'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        $items = $query->orderBy('graduation_year', 'desc')->paginate(15);

        return ApiResponse::success($items, 'Daftar alumni berhasil diambil.');
    }

    /**
     * Get aggregated alumni map data (Zero live geocoding).
     */
    public function getMapData(): JsonResponse
    {
        $data = $this->alumniService->getMapAggregatedData();

        return ApiResponse::success($data, 'Data peta sebaran alumni berhasil diambil.');
    }

    /**
     * Get alumni detail.
     */
    public function show(string $id): JsonResponse
    {
        $alumni = Alumni::query()
            ->where('publication_status', 'PUBLISHED')
            ->with(['major', 'portfolios' => function ($q) {
                $q->where('status', 'PUBLISHED');
            }])
            ->find($id);

        if (! $alumni) {
            return ApiResponse::error('Data alumni tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($alumni, 'Detail alumni berhasil diambil.');
    }
}
