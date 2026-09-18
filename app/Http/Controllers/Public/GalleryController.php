<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Gallery::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        $items = $query->orderBy('event_date', 'desc')->paginate(12);

        return ApiResponse::success($items, 'Data galeri berhasil diambil.');
    }
}
