<?php

namespace App\Services\EVoice;

use App\Models\EVoice;
use App\Models\EVoiceVote;
use Illuminate\Support\Str;

class EVoiceService
{
    /**
     * Submit a new E-Voice feedback item and return secure ticket code.
     */
    public function createEVoice(array $data): EVoice
    {
        $ticketCode = 'EVC-' . date('Ymd') . '-' . random_int(1000, 9999);

        $eVoice = EVoice::create([
            'ticket_code' => $ticketCode,
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'] ?? 'ASPIRASI',
        ]);

        try {
            $adminEmail = config('mail.from.address') ?: 'admin@smkn2mojokerto.sch.id';
            $adminUser = \App\Models\User::first();
            if ($adminUser && !empty($adminUser->email)) {
                $adminEmail = $adminUser->email;
            }
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\AdminEVoiceNotificationMail($eVoice));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Email notification failed for E-Voice: ' . $e->getMessage());
        }

        return $eVoice;
    }

    /**
     * Upvote an E-Voice entry while preventing duplicate IP votes.
     */
    public function upvote(string $eVoiceId, string $ipAddress): bool
    {
        $ipHash = hash('sha256', $ipAddress);

        $existingVote = EVoiceVote::query()
            ->where('e_voice_id', $eVoiceId)
            ->where('voter_ip_hash', $ipHash)
            ->exists();

        if ($existingVote) {
            return false;
        }

        EVoiceVote::create([
            'e_voice_id' => $eVoiceId,
            'voter_ip_hash' => $ipHash,
        ]);

        EVoice::query()
            ->where('id', $eVoiceId)
            ->increment('upvotes_count');

        return true;
    }
}
