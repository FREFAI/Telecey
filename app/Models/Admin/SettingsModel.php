<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $table = 'setting_preferences';
    protected $guard = 'admin';

    protected $fillable = [
        'setting_key','terms_and_conditions', 'status',
    ];
}
