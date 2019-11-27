<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Admin\SendEmailToUser;
use Mail;
class SendEmailToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $emails = array();
    protected $params = array();
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails,$params)
    {   
        $this->emails = $emails;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails = $this->emails;
        $params = $this->params;
        Mail::to($emails)->send(new SendEmailToUser($params));
    }
}
