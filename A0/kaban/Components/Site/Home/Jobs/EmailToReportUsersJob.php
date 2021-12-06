<?php

namespace Kaban\Components\Site\Home\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailToReportUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payload;

    protected $mailText;

    protected $mailSubject;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payload, $mailText,$mailSubject)
    {
        $this->payload = $payload;

        $this->mailText = $mailText;

        $this->mailSubject = $mailSubject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::send([], [], function ($message) {
            $message->to($this->payload['email'])
                ->subject($this->mailSubject)
//                ->from(..)
                ->setBody($this->mailText, 'text/html');
        });
    }
}
