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
    protected $email = "";
    protected $params = array();
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$params)
    {   
        $this->email = $email;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $params = $this->params;
        Mail::to($email)->send(new SendEmailToUser($params));
    }
}
