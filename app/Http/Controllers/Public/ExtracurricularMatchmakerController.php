<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ExtracurricularQuestion;
use App\Services\ExtracurricularMatchmaker\MatchmakerEngineService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ExtracurricularMatchmakerController extends Controller
{
    public function __construct(
        private MatchmakerEngineService $matchmakerEngine
    ) {}

    /**
     * Get quiz questions with multiple choice options.
     */
    public function getQuestions(): JsonResponse
    {
        $questions = Cache::remember('extracurricular.questions', 86400, function () {
            return ExtracurricularQuestion::query()
                ->where('is_active', true)
                ->with(['options' => function ($query) {
                    $query->select('id', 'question_id', 'option_text');
                }])
                ->orderBy('order', 'asc')
                ->get();
        });

        return ApiResponse::success($questions, 'Pertanyaan kuis ekstrakurikuler berhasil diambil.');
    }

    /**
     * Submit quiz options and calculate top matching extracurriculars.
     */
    public function calculateResult(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'option_ids' => ['nullable', 'array'],
            'option_ids.*' => ['nullable', 'string'],
        ]);

        $optionIds = array_filter($validated['option_ids'] ?? []);
        $matches = $this->matchmakerEngine->calculateMatches($optionIds);

        return ApiResponse::success($matches, 'Hasil rekomendasi ekstrakurikuler berhasil dihitung.');
    }
}
