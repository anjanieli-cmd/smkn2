<?php

namespace App\Models;

use App\Enums\ChatbotKnowledgeStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ChatbotKnowledge extends Model
{
    use HasUuids;

    protected $table = 'chatbot_knowledge';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'category',
        'content',
        'keywords',
        'status',
        'is_ai_allowed',
        'priority',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'keywords' => 'array',
            'status' => ChatbotKnowledgeStatus::class,
            'is_ai_allowed' => 'boolean',
            'priority' => 'integer',
            'published_at' => 'datetime',
        ];
    }
}
