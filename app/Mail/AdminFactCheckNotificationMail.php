<?php

namespace App\Mail;

use App\Models\FactCheck;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminFactCheckNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FactCheck $factCheck
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[FactCheck SMKN 2] Laporan Kabar Hoax / Klarifikasi Isu Baru',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-factcheck-notification',
        );
    }
}
