<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EVoice;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EVoiceAdminController extends Controller
{
    public function index(): JsonResponse
    {
        $items = EVoice::query()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return ApiResponse::success($items, 'Data pengaduan E-Voice berhasil diambil.');
    }

    public function updateStatus(Request $request, string $id): JsonResponse
    {
        $item = EVoice::query()->find($id);

        if (! $item) {
            return ApiResponse::error('E-Voice tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:SUBMITTED,REVIEWING,IN_PROGRESS,RESOLVED,CLOSED'],
        ]);

        $item->update(['status' => $validated['status']]);

        return ApiResponse::success($item, 'Status E-Voice berhasil diperbarui.');
    }
}
