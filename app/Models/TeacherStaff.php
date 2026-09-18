<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TeacherStaff extends Model
{
    use HasUuids;

    protected $table = 'teachers_staff';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'nip',
        'role_position',
        'photo_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
