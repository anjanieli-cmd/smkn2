<?php

namespace App\Interfaces\AI;

interface AIProviderInterface
{
    /**
     * Generate AI response based on minimal relevant school context.
     *
     * @param string $userPrompt
     * @param array<int, string> $contextChunks
     * @return string
     */
    public function generateResponse(string $userPrompt, array $contextChunks): string;
}
