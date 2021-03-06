<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;
	protected $table = 'admins';
	protected $dates = ['deleted_at'];
    protected $guard = 'admin';

    protected $fillable = [
        'firstname','lastname', 'type','email', 'password','date_of_birth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}