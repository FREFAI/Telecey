<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'user_id', 'log_type', 'login_signup_type', 'type', 'ip', 'user_status', 'user_name', 'user_number', 'email', 'filter_params', 'filter_type', 'filter_search_result_count', 'request_type', 'reuqest_param_name', 'appr_disapp_status', 'created_at', 'updated_at'
    ];
}
