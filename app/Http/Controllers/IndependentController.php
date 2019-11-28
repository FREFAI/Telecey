<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateNickName;
use Illuminate\Http\Request;
use App\User;
use DB;

class IndependentController extends Controller
{
   
    public function addNikNameIfNotExist()
    {
      $users = User::get();
      
      foreach($users as $user){
        if($user->nickname == ""){
          $nickname = GenerateNickName::nickName($user->firstname);
          $user->nickname = $nickname;
          $user->save();
        } 
      }
      return json_encode(array('success'=>true));
    }
}
