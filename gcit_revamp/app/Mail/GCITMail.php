<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GCITMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('OTP Code')
                    ->view('emails.otp')
                    ->attach(public_path('images/logo/logo1.png'))
                    ->with([
                        'otp' => $this->otp
                    ]);;
    }
}
