<?php

namespace App\Services\Alumni;

use App\Models\Alumni;
use Illuminate\Support\Facades\Cache;

class AlumniService
{
    /**
     * Get aggregated alumni map location data.
     * Zero live geocoding during public map requests.
     */
    public function getMapAggregatedData(): array
    {
        return Cache::remember('alumni.map.aggregated', 86400, function () {
            return Alumni::query()
                ->where('publication_status', 'PUBLISHED')
                ->whereNotNull('city')
                ->selectRaw('city, country, latitude, longitude, COUNT(*) as total_alumni')
                ->groupBy('city', 'country', 'latitude', 'longitude')
                ->get()
                ->toArray();
        });
    }
}
