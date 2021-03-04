<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params = array())
    {
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->params['file']){
            return $this->view('emailtemplates.admin.userEmailSend',['data'=> $this->params])->subject($this->params['subject'])->attach($this->params['file']);
        }else{
            return $this->view('emailtemplates.admin.userEmailSend',['data'=> $this->params])->subject($this->params['subject']);
        }
    }
}
