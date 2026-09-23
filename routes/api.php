<?php

use App\Http\Controllers\Admin\AlumniAdminController;
use App\Http\Controllers\Admin\ChatbotKnowledgeAdminController;
use App\Http\Controllers\Admin\EVoiceAdminController;
use App\Http\Controllers\Admin\ExtracurricularAdminController;
use App\Http\Controllers\Admin\FactCheckAdminController;
use App\Http\Controllers\Admin\IndustryAdminController;
use App\Http\Controllers\Admin\JobVacancyAdminController;
use App\Http\Controllers\Admin\MajorAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\StudentWorkAdminController;
use App\Http\Controllers\Admin\TeacherStaffAdminController;
use App\Http\Controllers\Public\AlumniController;
use App\Http\Controllers\Public\BkkController;
use App\Http\Controllers\Public\ChatbotController;
use App\Http\Controllers\Public\EVoiceController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\ExtracurricularMatchmakerController;
use App\Http\Controllers\Public\FactCheckController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\MajorController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\SchoolProfileController;
use App\Http\Controllers\Public\TourController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes (Guest / No Login Required)
|--------------------------------------------------------------------------
*/

Route::prefix('school')->group(function () {
    Route::get('/profile', [SchoolProfileController::class, 'getProfile']);
    Route::get('/staff', [SchoolProfileController::class, 'getStaff']);
});

Route::get('/majors', [MajorController::class, 'index']);
Route::get('/majors/{identifier}', [MajorController::class, 'show']);

Route::get('/extracurriculars', [ExtracurricularController::class, 'index']);
Route::get('/extracurriculars/{identifier}', [ExtracurricularController::class, 'show']);

Route::prefix('extracurricular-matchmaker')->group(function () {
    Route::get('/questions', [ExtracurricularMatchmakerController::class, 'getQuestions']);
    Route::post('/result', [ExtracurricularMatchmakerController::class, 'calculateResult']);
});

Route::prefix('e-voice')->group(function () {
    Route::get('/', [EVoiceController::class, 'index']);
    Route::post('/', [EVoiceController::class, 'store']);
    Route::get('/ticket/{ticketCode}', [EVoiceController::class, 'showByTicket']);
    Route::post('/{id}/upvote', [EVoiceController::class, 'upvote']);
});

Route::prefix('fact-check')->group(function () {
    Route::get('/', [FactCheckController::class, 'index']);
    Route::post('/report', [FactCheckController::class, 'report']);
    Route::get('/{id}', [FactCheckController::class, 'show']);
});

Route::prefix('tour')->group(function () {
    Route::get('/', [TourController::class, 'index']);
    Route::get('/locations/{id}', [TourController::class, 'show']);
});

Route::prefix('alumni')->group(function () {
    Route::get('/', [AlumniController::class, 'index']);
    Route::get('/map', [AlumniController::class, 'getMapData']);
    Route::get('/{id}', [AlumniController::class, 'show']);
});

Route::prefix('bkk')->group(function () {
    Route::get('/jobs', [BkkController::class, 'getJobs']);
    Route::get('/partnerships', [BkkController::class, 'getPartnerships']);
});

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{identifier}', [NewsController::class, 'show']);

Route::get('/gallery', [GalleryController::class, 'index']);

Route::prefix('chatbot')->group(function () {
    Route::post('/message', [ChatbotController::class, 'sendMessage']);
});

/*
|--------------------------------------------------------------------------
| Protected Admin API Routes (/api/admin/...)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::prefix('chatbot/knowledge')->group(function () {
        Route::get('/', [ChatbotKnowledgeAdminController::class, 'index']);
        Route::post('/', [ChatbotKnowledgeAdminController::class, 'store']);
        Route::put('/{id}', [ChatbotKnowledgeAdminController::class, 'update']);
        Route::delete('/{id}', [ChatbotKnowledgeAdminController::class, 'destroy']);
    });

    Route::prefix('fact-check')->group(function () {
        Route::get('/', [FactCheckAdminController::class, 'index']);
        Route::post('/', [FactCheckAdminController::class, 'store']);
        Route::put('/{id}', [FactCheckAdminController::class, 'update']);
        Route::delete('/{id}', [FactCheckAdminController::class, 'destroy']);
    });

    Route::prefix('e-voice')->group(function () {
        Route::get('/', [EVoiceAdminController::class, 'index']);
        Route::put('/{id}/status', [EVoiceAdminController::class, 'updateStatus']);
    });

    Route::prefix('alumni')->group(function () {
        Route::post('/', [AlumniAdminController::class, 'store']);
        Route::put('/{id}', [AlumniAdminController::class, 'update']);
        Route::delete('/{id}', [AlumniAdminController::class, 'destroy']);
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [NewsAdminController::class, 'index']);
        Route::post('/', [NewsAdminController::class, 'store']);
        Route::get('/{id}', [NewsAdminController::class, 'show']);
        Route::put('/{id}', [NewsAdminController::class, 'update']);
        Route::delete('/{id}', [NewsAdminController::class, 'destroy']);
    });

    Route::prefix('teacher-staff')->group(function () {
        Route::get('/', [TeacherStaffAdminController::class, 'index']);
        Route::post('/', [TeacherStaffAdminController::class, 'store']);
        Route::get('/{id}', [TeacherStaffAdminController::class, 'show']);
        Route::put('/{id}', [TeacherStaffAdminController::class, 'update']);
        Route::delete('/{id}', [TeacherStaffAdminController::class, 'destroy']);
    });

    Route::prefix('job-vacancies')->group(function () {
        Route::get('/', [JobVacancyAdminController::class, 'index']);
        Route::post('/', [JobVacancyAdminController::class, 'store']);
        Route::get('/{id}', [JobVacancyAdminController::class, 'show']);
        Route::put('/{id}', [JobVacancyAdminController::class, 'update']);
        Route::delete('/{id}', [JobVacancyAdminController::class, 'destroy']);
    });

    Route::prefix('industry-partnerships')->group(function () {
        Route::get('/', [IndustryAdminController::class, 'index']);
        Route::post('/', [IndustryAdminController::class, 'store']);
        Route::get('/{id}', [IndustryAdminController::class, 'show']);
        Route::put('/{id}', [IndustryAdminController::class, 'update']);
        Route::delete('/{id}', [IndustryAdminController::class, 'destroy']);
    });

    Route::prefix('majors')->group(function () {
        Route::get('/', [MajorAdminController::class, 'index']);
        Route::post('/', [MajorAdminController::class, 'store']);
        Route::get('/{id}', [MajorAdminController::class, 'show']);
        Route::put('/{id}', [MajorAdminController::class, 'update']);
        Route::delete('/{id}', [MajorAdminController::class, 'destroy']);
    });

    Route::prefix('extracurriculars')->group(function () {
        Route::get('/', [ExtracurricularAdminController::class, 'index']);
        Route::post('/', [ExtracurricularAdminController::class, 'store']);
        Route::get('/{id}', [ExtracurricularAdminController::class, 'show']);
        Route::put('/{id}', [ExtracurricularAdminController::class, 'update']);
        Route::delete('/{id}', [ExtracurricularAdminController::class, 'destroy']);
    });

    Route::prefix('student-works')->group(function () {
        Route::get('/', [StudentWorkAdminController::class, 'index']);
        Route::post('/', [StudentWorkAdminController::class, 'store']);
        Route::get('/{id}', [StudentWorkAdminController::class, 'show']);
        Route::put('/{id}', [StudentWorkAdminController::class, 'update']);
        Route::delete('/{id}', [StudentWorkAdminController::class, 'destroy']);
    });
});
