<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\ChatbotKnowledge;
use App\Models\EVoice;
use App\Models\Extracurricular;
use App\Models\FactCheck;
use App\Models\IndustryPartnership;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\NewsArticle;
use App\Models\StudentWork;
use App\Models\TeacherStaff;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan data statistik dinamis.
     */
    public function index()
    {
        $stats = [
            'total_news' => NewsArticle::query()->count(),
            'total_teachers' => TeacherStaff::query()->where('is_active', true)->count(),
            'total_majors' => Major::query()->where('is_active', true)->count(),
            'total_extracurriculars' => Extracurricular::query()->where('is_active', true)->count(),
            'total_jobs' => JobVacancy::query()->where('status', 'OPEN')->count(),
            'total_evoice_unread' => EVoice::query()->where('status', 'SUBMITTED')->count(),
            'total_factchecks' => FactCheck::query()->count(),
            'total_student_works' => StudentWork::query()->count(),
            'total_industry' => IndustryPartnership::query()->where('is_active', true)->count(),
            'total_alumni' => Alumni::query()->count(),
            'total_knowledge' => ChatbotKnowledge::query()->count(),
        ];

        $recentNews = NewsArticle::query()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentEVoices = EVoice::query()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentNews', 'recentEVoices'));
    }
}