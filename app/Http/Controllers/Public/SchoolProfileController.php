<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\TeacherStaff;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SchoolProfileController extends Controller
{
    /**
     * Get official school profile information (Sejarah, Visi Misi, Struktur, Roadmap).
     */
    public function getProfile(): JsonResponse
    {
        $profiles = Cache::remember('school.profile.all', 86400, function () {
            return SchoolProfile::query()->get()->pluck('content', 'key');
        });

        return ApiResponse::success($profiles, 'Data profil sekolah berhasil diambil.');
    }

    /**
     * Get teachers & staff directory.
     */
    public function getStaff(): JsonResponse
    {
        $staff = Cache::remember('school.staff.active', 86400, function () {
            return TeacherStaff::query()
                ->where('is_active', true)
                ->get();
        });

        return ApiResponse::success($staff, 'Data guru dan staf berhasil diambil.');
    }
}
