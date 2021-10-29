<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
//    public function __construct($subject,$userMail,$name,$message)
    public function __construct($req)
    {
//        $this->subject = $subject;
//        $this->userMail = $userMail;
//        $this->name = $name;
//        $this->message = $message;
        $this->req = $req;
//        dd(12);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $req = (object)$this->req;
        return $this->subject($req->subject)->markdown('emails.contact',['req'=>$req]);
    }
}
