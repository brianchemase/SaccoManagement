<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberStatementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $member;

    /**
     * Create a new message instance.
     */
    public function __construct($pdf, $member)
    {
        $this->pdf = $pdf;
        $this->member = $member;
    }

       public function build()
    {
        return $this->subject('Sacco Member Savings Statement')
            ->view('emails.member_statement') // create this view
            ->attachData($this->pdf->output(), 'SavingsStatement.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
