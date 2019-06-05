<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    protected $table = 'service_ratings';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'service_id', 'coverage', 'service_stability', 'billing_payment', 'data_speed', 'service_waiting', 'voice_quality','rating_average'
    ];
}
