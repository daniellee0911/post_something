<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\HaveSomeCommentEmail;
use Mail;


class SendEmailJob implements ShouldQueue
{
    use Queueable;

    protected $mailAddress;
    protected $mailData;
    
    /**
     * Create a new job instance.
     */
    public function __construct($mailAddress,$mailData)
    {
        $this->mailAddress = $mailAddress;
        $this->mailData = $mailData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->mailAddress)->send(new HaveSomeCommentEmail($this->mailData));
    }
}