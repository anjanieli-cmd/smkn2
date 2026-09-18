<?php

namespace App\Services\ExtracurricularMatchmaker;

use App\Models\Extracurricular;
use App\Models\ExtracurricularOption;

class MatchmakerEngineService
{
    /**
     * Calculate extracurricular match percentages based on quiz option answers.
     *
     * @param array<int, string> $selectedOptionIds Array of option UUIDs selected by user
     * @return array<int, array{extracurricular: Extracurricular, score: int, percentage: float}>
     */
    public function calculateMatches(array $selectedOptionIds): array
    {
        $options = ExtracurricularOption::query()
            ->whereIn('id', $selectedOptionIds)
            ->get();

        $scores = [];

        foreach ($options as $option) {
            $scoreMap = $option->extracurricular_scores;
            if (is_array($scoreMap)) {
                foreach ($scoreMap as $ekskulName => $addedScore) {
                    $scores[$ekskulName] = ($scores[$ekskulName] ?? 0) + (int) $addedScore;
                }
            }
        }

        arsort($scores);

        $maxPossibleScore = count($selectedOptionIds) * 10;
        if ($maxPossibleScore === 0) {
            $maxPossibleScore = 1;
        }

        $results = [];
        $activeEkskuls = Extracurricular::query()
            ->where('is_active', true)
            ->get()
            ->keyBy('name');

        foreach ($scores as $ekskulName => $totalScore) {
            if ($activeEkskuls->has($ekskulName)) {
                $percentage = min(100.0, round(($totalScore / $maxPossibleScore) * 100, 1));
                $results[] = [
                    'extracurricular' => $activeEkskuls->get($ekskulName),
                    'score' => $totalScore,
                    'percentage' => $percentage,
                ];
            }
        }

        return array_slice($results, 0, 3); // Return top 3 matches
    }
}
