<?php

namespace App\Models;

use App\Enums\PortfolioCategory;
use App\Enums\PortfolioStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'author_name',
        'alumni_id',
        'category',
        'project_url',
        'thumbnail_url',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'category' => PortfolioCategory::class,
            'status' => PortfolioStatus::class,
            'published_at' => 'datetime',
        ];
    }

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }
}
