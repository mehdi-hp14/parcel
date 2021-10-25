<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class ContactMail extends Mailable

{

    use Queueable, SerializesModels;



    public $subject;
    public $userMail;
    public $name;
    public $message;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($subject,$userMail,$name,$message)
    {
        $this->subject = $subject;
        $this->userMail = $userMail;
        $this->name = $name;
        $this->message = $message;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->subject('Mail from ItSolutionStuff.com')

            ->view('emails.myTestMail');

    }

}
