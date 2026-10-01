<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourHotspot extends Model
{
    protected $fillable = [
        'tour_scene_id', 'target_scene_id', 'pitch', 'yaw', 'label', 'icon', 'order',
    ];

    protected $casts = [
        'pitch' => 'float',
        'yaw'   => 'float',
    ];

    /** Scene tempat hotspot ini berada. */
    public function scene(): BelongsTo
    {
        return $this->belongsTo(TourScene::class, 'tour_scene_id');
    }

    /** Scene tujuan saat hotspot diklik. */
    public function target(): BelongsTo
    {
        return $this->belongsTo(TourScene::class, 'target_scene_id');
    }
}
