<?php

namespace App\Models;

use App\Enums\AlumniStatus;
use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    use HasUuids;

    protected $table = 'alumni';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'photo_url',
        'graduation_year',
        'major_id',
        'status',
        'university',
        'company',
        'job_title',
        'career_field',
        'city',
        'country',
        'latitude',
        'longitude',
        'linkedin_url',
        'portfolio_url',
        'publication_status',
    ];

    protected function casts(): array
    {
        return [
            'graduation_year' => 'integer',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'status' => AlumniStatus::class,
            'publication_status' => PublicationStatus::class,
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }
}
