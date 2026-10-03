<?php

namespace App\Mail;

use App\Models\EVoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminEVoiceNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EVoice $eVoice
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[E-Voice SMKN 2] Laporan Aspirasi / Pengaduan Baru: ' . $this->eVoice->ticket_code,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-evoice-notification',
        );
    }
}
