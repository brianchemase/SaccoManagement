<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PyrethrumIntroductionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Partnership Inquiry – Premium Pyrethrum Extract from Kenya')
                    ->markdown('emails.pyrethrum');
    }

    
}
