<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class TestMail extends Mailable

{

    use Queueable, SerializesModels;



    public $details;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($details)

    {

        $this->details = $details;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->subject('Mail from ItSolutionStuff.com')

            ->view('vendor.notifications.email',[
                'actionText'=>'this is a actionText',
                'actionUrl'=>'this is a actionUrl',
                'greeting'=>'this is $greeting',
                'introLines'=>[
                    'this is introline1',
                    'this is introline2',
                    'this is introline3',
                ],
                'level'=>'success',
                'outroLines'=>[],
                'displayableActionUrl'=>'displayableActionUrl',
                ]);

    }

}
