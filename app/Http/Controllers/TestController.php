<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Mail;

class TestController extends Controller
{
   
    public function index()
    {
      echo "hello world this is only testing purpose.";
    }

    public function testEmail(Request $request){
      $email = "jatinder.kumar@softradix.com";
      Mail::raw('Hi Jatinder', function($m) use($email){
        $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $m->to($email);
        $m->subject('Testing Email');
      });
    }

}
