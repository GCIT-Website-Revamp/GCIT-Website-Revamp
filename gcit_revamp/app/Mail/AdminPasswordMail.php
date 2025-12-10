<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $randomPassword;

    public function __construct($randomPassword)
    {
        $this->randomPassword = $randomPassword;
    }

    public function build()
    {
        return $this->subject('Admin Password')
                    ->view('emails.password')
                    ->with([
                        'randomPassword' => $this->randomPassword
                    ]);
    }
}

