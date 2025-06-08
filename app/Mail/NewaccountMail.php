<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewaccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(

            subject: 'New Account Created',
            from:'aa2450775@gmail.com'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.send_email',
            with: ['data' => $this->data]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}