<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('Admin.LoginSignup.forgotpassword_form');
    }
}
