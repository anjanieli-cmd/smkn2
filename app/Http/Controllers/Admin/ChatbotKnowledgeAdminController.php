<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotKnowledge;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChatbotKnowledgeAdminController extends Controller
{
    public function index(): JsonResponse
    {
        $items = ChatbotKnowledge::query()->orderBy('priority', 'desc')->paginate(15);
        return ApiResponse::success($items, 'Data knowledge base chatbot berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'content' => ['required', 'string'],
            'keywords' => ['nullable', 'array'],
            'status' => ['required', 'string'],
            'is_ai_allowed' => ['boolean'],
            'priority' => ['integer'],
        ]);

        $item = ChatbotKnowledge::create($validated);
        Cache::forget('chatbot.knowledge.published');

        return ApiResponse::success($item, 'Knowledge base chatbot berhasil ditambahkan.', null, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = ChatbotKnowledge::query()->find($id);

        if (! $item) {
            return ApiResponse::error('Knowledge tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string'],
            'content' => ['sometimes', 'string'],
            'keywords' => ['nullable', 'array'],
            'status' => ['sometimes', 'string'],
            'is_ai_allowed' => ['boolean'],
            'priority' => ['integer'],
        ]);

        $item->update($validated);
        Cache::forget('chatbot.knowledge.published');

        return ApiResponse::success($item, 'Knowledge base chatbot berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $item = ChatbotKnowledge::query()->find($id);

        if (! $item) {
            return ApiResponse::error('Knowledge tidak ditemukan.', null, 404);
        }

        $item->delete();
        Cache::forget('chatbot.knowledge.published');

        return ApiResponse::success(null, 'Knowledge base chatbot berhasil dihapus.');
    }
}
