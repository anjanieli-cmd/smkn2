<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentWork extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'student_name',
        'major_id',
        'description',
        'media_url',
        'status',
    ];

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
