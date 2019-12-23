<?php

namespace App\Jobs;

use App\Mail\SendNewsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer as IlluminateMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
   
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $bodyMessage = $this->data['bodyMessage'];
        $email = $this->data['email'];
        $mailer->to($email, $email)->send(new SendNewsletter($bodyMessage));
    }
}
