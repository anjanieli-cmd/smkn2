<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EVoice;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EVoiceAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = EVoice::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->input('status') !== '' && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(15);

        return ApiResponse::success($items, 'Data pengaduan E-Voice berhasil diambil.');
    }

    public function show(string $id): JsonResponse
    {
        $item = EVoice::query()->find($id);

        if (! $item) {
            return ApiResponse::error('E-Voice tidak ditemukan.', null, 404);
        }

        return ApiResponse::success($item, 'Detail pengaduan E-Voice berhasil diambil.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        $validated['ticket_code'] = 'EV-' . strtoupper(\Illuminate\Support\Str::random(4)) . '-' . date('Y');
        $validated['status'] = $validated['status'] ?? 'REVIEWING';
        $validated['category'] = $validated['category'] ?? 'ASPIRASI';
        $validated['upvotes_count'] = 0;

        $item = EVoice::create($validated);

        return ApiResponse::success($item, 'Pengaduan / Aspirasi E-Voice berhasil dibuat.', null, 201);
    }

    public function updateStatus(Request $request, string $id): JsonResponse
    {
        $item = EVoice::query()->find($id);

        if (! $item) {
            return ApiResponse::error('E-Voice tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:SUBMITTED,REVIEWING,IN_PROGRESS,RESOLVED'],
            'admin_response' => ['nullable', 'string', 'max:2000'],
        ]);

        $item->update($validated);

        return ApiResponse::success($item, 'Status dan tanggapan E-Voice berhasil diperbarui.');
    }

    public function destroy(string $id): JsonResponse
    {
        $item = EVoice::query()->find($id);

        if (! $item) {
            return ApiResponse::error('E-Voice tidak ditemukan.', null, 404);
        }

        $item->delete();

        return ApiResponse::success(null, 'Pengaduan E-Voice berhasil dihapus.');
    }
}
