<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'icon_url',
        'is_active',
        'details',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'details'   => 'array',
        ];
    }

    public function getDetail(string $key, mixed $default = null): mixed
    {
        return data_get($this->details, $key, $default);
    }

    public function alumni(): HasMany
    {
        return $this->hasMany(Alumni::class);
    }

    public function studentWorks(): HasMany
    {
        return $this->hasMany(StudentWork::class);
    }
}
