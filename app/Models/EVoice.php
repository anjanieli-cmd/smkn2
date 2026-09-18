<?php

namespace App\Models;

use App\Enums\EVoiceCategory;
use App\Enums\EVoiceStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EVoice extends Model
{
    use HasUuids;

    protected $table = 'e_voices';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'ticket_code',
        'title',
        'description',
        'category',
        'upvotes_count',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'category' => EVoiceCategory::class,
            'status' => EVoiceStatus::class,
            'upvotes_count' => 'integer',
        ];
    }

    public function votes(): HasMany
    {
        return $this->hasMany(EVoiceVote::class, 'e_voice_id');
    }
}
