<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class WelcomeMail extends Mailable{

    use Queueable, SerializesModels;

    public function build(){
        return $this->subject('Welcome to Confident Lavarel!')->view('emails.html.welcome')->text('emails.text.welcome');
    }
}
