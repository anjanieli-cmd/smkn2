<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\IndustryPartnership;
use App\Models\JobVacancy;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class BkkController extends Controller
{
    /**
     * Get active job vacancies.
     */
    public function getJobs(): JsonResponse
    {
        $jobs = JobVacancy::query()
            ->where('status', 'ACTIVE')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return ApiResponse::success($jobs, 'Daftar lowongan kerja BKK berhasil diambil.');
    }

    /**
     * Get industry partnerships.
     */
    public function getPartnerships(): JsonResponse
    {
        $partnerships = Cache::remember('bkk.partnerships', 86400, function () {
            return IndustryPartnership::query()
                ->where('is_active', true)
                ->get();
        });

        return ApiResponse::success($partnerships, 'Daftar kerja sama industri berhasil diambil.');
    }
}
