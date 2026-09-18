<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\EVoice;
use App\Services\EVoice\EVoiceService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EVoiceController extends Controller
{
    public function __construct(
        private EVoiceService $eVoiceService
    ) {}

    /**
     * Get list of public E-Voice submissions.
     */
    public function index(Request $request): JsonResponse
    {
        $query = EVoice::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        $items = $query->orderBy('upvotes_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return ApiResponse::success($items, 'Daftar E-Voice berhasil diambil.');
    }

    /**
     * Submit new E-Voice entry.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string'],
        ]);

        $eVoice = $this->eVoiceService->createEVoice($validated);

        return ApiResponse::success($eVoice, 'Aspirasi/Pengaduan Anda berhasil dikirim.', null, 201);
    }

    /**
     * Check E-Voice status by ticket code.
     */
    public function showByTicket(string $ticketCode): JsonResponse
    {
        $item = EVoice::query()
            ->where('ticket_code', $ticketCode)
            ->first();

        if (! $item) {
            return ApiResponse::error('Tiket E-Voice tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($item, 'Status tiket E-Voice berhasil ditemukan.');
    }

    /**
     * Upvote an E-Voice submission.
     */
    public function upvote(Request $request, string $id): JsonResponse
    {
        $ip = $request->ip() ?? '127.0.0.1';
        $success = $this->eVoiceService->upvote($id, $ip);

        if (! $success) {
            return ApiResponse::error('Anda sudah memberikan voting untuk aspirasi ini.', null, 422);
        }

        return ApiResponse::success(null, 'Dukungan voting berhasil ditambahkan.');
    }
}
