<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $guard = 'admin';
    /**
     * log_type :- 1 for signup, 2 for email verification, 3 for login user,4 for search device, 5 for search plans, 6 for message, 7 for approved/unapproved, 8 for send email to user from admin
     */
    protected $fillable = [
        'id', 'user_id', 'log_type','from','to','subject', 'login_signup_type', 'type', 'ip', 'user_status', 'user_name', 'user_number', 'email', 'filter_params', 'filter_type', 'filter_search_result_count', 'request_type', 'reuqest_param_name', 'appr_disapp_status', 'created_at', 'updated_at'
    ];
    public function user(){
        return $this->hasOne('App\User','id', 'to');
    }
    public function admin(){
        return $this->hasOne('App\Models\Admin\AdminModel','id', 'from');
    }
}
