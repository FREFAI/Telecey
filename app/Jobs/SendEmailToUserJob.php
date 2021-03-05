<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Admin\SendEmailToUser;
use App\Models\Admin\Logs;
use App\User;
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
        $user = User::select('id','is_active')->where('email',$email)->first();
        $data = [
            'log_type'=> 8,
            'type'=> 1,
            'from' => $params['admin_id'],
            'to' => $user->id,
            'user_status' => $user->user_status,
            'subject' => $params['subject']
        ];
        Logs::create($data);
    }
}
