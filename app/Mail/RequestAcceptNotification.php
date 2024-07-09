<?php

namespace App\Mail;

use App\Models\RequestedEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestAcceptNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $requestedEntry;
    public $whatsappLink;

    /**
     * Create a new message instance.
     */
    public function __construct(RequestedEntry $requestedEntry, $whatsappLink)
    {
        $this->requestedEntry = $requestedEntry;
        $this->whatsappLink = $whatsappLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitud Aceptada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.requestAcceptNotification',
            with: [
                'requestedEntry' => $this->requestedEntry,
                'whatsappLink' => $this->whatsappLink
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
