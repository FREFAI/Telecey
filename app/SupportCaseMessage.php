<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportCaseMessage extends Model
{
    protected $table = 'support_case_messages';
    protected $fillable = [
        'id', 'sender_id', 'receiver_id', 'case_id', 'message', 'is_read', 'created_at', 'updated_at'
    ];
}
