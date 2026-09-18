<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\Chatbot\ChatbotService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function __construct(
        private ChatbotService $chatbotService
    ) {}

    /**
     * Send message to AI School Assistant.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);

        $result = $this->chatbotService->processMessage($validated['message']);

        return ApiResponse::success([
            'response_type' => $result['response_type'],
            'message' => $result['message'],
        ], 'Response chatbot berhasil diproses.', [
            'latency' => [
                'retrieval_duration_ms' => $result['retrieval_ms'],
                'ai_duration_ms' => $result['ai_ms'],
                'total_duration_ms' => $result['total_ms'],
            ],
        ]);
    }
}
