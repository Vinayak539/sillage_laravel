<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $bodyMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bodyMessage)
    {
        $this->bodyMessage = $bodyMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.mails.subscribe-message')
            ->subject('Newsletter From HNI LIFESTYLE')
            ->from('support@ranayas.com', 'HNI LIFESTYLE');
    }
}
