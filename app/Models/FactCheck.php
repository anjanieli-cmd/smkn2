<?php

namespace App\Models;

use App\Enums\FactCheckStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FactCheck extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'claim',
        'verdict_explanation',
        'status',
        'source_url',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => FactCheckStatus::class,
            'published_at' => 'datetime',
        ];
    }
}
