<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'password','user_address_id','nickname','is_active','feedback_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAdderss()
    {
        return $this->hasOne('App\UserAddress', 'user_id', 'id')->where('is_primary','=', 1);
    }
    public function plans() {
          return $this->hasMany('App\Models\FrontEnd\ServiceReview','user_id','id');
    }
    public function devices() {
          return $this->hasMany('App\Models\FrontEnd\DeviceReview','user_id','id');
    }
    public function providers() {
          return $this->hasMany('App\Models\Admin\Provider','user_id','id');
    }
    public function getUnapprovedProviders() {
        return $this->providers()->where('status', 0)->get();
    }
    public function userPrimaryAdderss()
    {
        return $this->hasOne('App\UserAddress', 'user_id', 'id');
    }
    public function getUserPrimaryAdderss() {
        return $this->userPrimaryAdderss()->where('is_primary', 1)->first();
    }
}
