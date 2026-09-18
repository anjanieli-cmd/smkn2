<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EVoiceVote extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'e_voice_id',
        'voter_ip_hash',
    ];

    public function eVoice(): BelongsTo
    {
        return $this->belongsTo(EVoice::class, 'e_voice_id');
    }
}
