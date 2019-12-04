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
      $email = $request->email;
      Mail::raw('Hi Jatinder', function($m) use($email){
        $m->from('support@telkoc.com', 'Laravel');
        $m->to($email);
        $m->subject('Testing Email');
      });
    }

}
