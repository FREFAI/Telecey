<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportCase extends Model
{
    protected $table = 'support_cases';
    protected $fillable = [
        'id', 'user_id', 'subject', 'message', 'status', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
