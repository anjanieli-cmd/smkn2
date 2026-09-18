<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtracurricularOption extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'question_id',
        'option_text',
        'extracurricular_scores',
    ];

    protected function casts(): array
    {
        return [
            'extracurricular_scores' => 'array',
        ];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(ExtracurricularQuestion::class, 'question_id');
    }
}
