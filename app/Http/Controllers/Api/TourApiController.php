<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourScene;

class TourApiController extends Controller
{
    /** GET /api/tour — dipakai halaman publik profile/tour.blade.php */
    public function index()
    {
        $scenes = TourScene::with('hotspots.target')->orderBy('order')->orderBy('id')->get();

        return response()->json([
            'success' => true,
            'data' => $scenes->map(fn (TourScene $s) => [
                'slug'        => $s->slug,
                'title'       => $s->title,
                'category'    => $s->category,
                'icon'        => $s->icon,
                'description' => $s->description,
                'panorama'    => $s->panorama_url ? $s->panorama_url . '?v=' . $s->updated_at->timestamp : null,
                'haov'        => $s->haov,
                'vaov'        => $s->vaov,
                'vOffset'     => $s->v_offset,
                'is_home'     => $s->is_home,
                'hotspots'    => $s->hotspots
                    ->filter(fn ($h) => $h->target)
                    ->map(fn ($h) => [
                        'pitch' => $h->pitch,
                        'yaw'   => $h->yaw,
                        'to'    => $h->target->slug,
                        'label' => $h->label,
                        'icon'  => $h->icon,
                    ])->values(),
            ])->values(),
        ]);
    }
}
