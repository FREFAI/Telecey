<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;


class SocialAuthFacebookController extends Controller
{
    /**
       * Create a redirect method to facebook api.
       *
       * @return void
       */
        public function redirect()
        {
            return Socialite::driver('facebook')->redirect();
        }

        /**
         * Return a callback method from facebook api.
         *
         * @return callback URL from facebook
         */
        public function callback()
        {
           
        }
}
