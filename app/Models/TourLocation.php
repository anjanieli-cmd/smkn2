<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourLocation extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'building',
        'room',
        'panorama_url',
        'description',
    ];

    public function hotspots(): HasMany
    {
        return $this->hasMany(TourHotspot::class, 'location_id');
    }
}
