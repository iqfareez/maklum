<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $feedbackData;

    /**
     * Create a new message instance.
     */
    public function __construct($feedbackData)
    {
        $this->feedbackData = $feedbackData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $sender_email = data_get($this->feedbackData, 'email');

        return new Envelope(
            subject: 'MPT Feedback Received',
            replyTo: $sender_email != null ? [
                new Address($sender_email, data_get($this->feedbackData, 'name'))
            ] : null,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.feedback',
            with: [
                'feedback' => $this->feedbackData,
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
