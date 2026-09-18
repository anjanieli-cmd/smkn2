<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TourLocation;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class TourController extends Controller
{
    /**
     * Get 360 tour locations.
     */
    public function index(): JsonResponse
    {
        $locations = Cache::remember('tour.locations', 86400, function () {
            return TourLocation::query()
                ->with('hotspots')
                ->get();
        });

        return ApiResponse::success($locations, 'Lokasi tour virtual 360 berhasil diambil.');
    }

    /**
     * Show single tour location with hotspots.
     */
    public function show(string $id): JsonResponse
    {
        $location = TourLocation::query()
            ->with(['hotspots.targetLocation'])
            ->find($id);

        if (! $location) {
            return ApiResponse::error('Lokasi tour tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($location, 'Detail lokasi tour berhasil diambil.');
    }
}
