<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourHotspot extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'location_id',
        'target_location_id',
        'title',
        'pitch',
        'yaw',
    ];

    protected function casts(): array
    {
        return [
            'pitch' => 'float',
            'yaw' => 'float',
        ];
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(TourLocation::class, 'location_id');
    }

    public function targetLocation(): BelongsTo
    {
        return $this->belongsTo(TourLocation::class, 'target_location_id');
    }
}
