<?php

namespace App\Models;

use App\Enums\JobVacancyStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'company_name',
        'location',
        'description',
        'apply_url',
        'deadline',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'status' => JobVacancyStatus::class,
        ];
    }
}
