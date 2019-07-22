<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class DeviceReview extends Model
{
    protected $table = 'device_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'device_id', 'brand_id', 'model_id', 'price', 'currency_id', 'storage', 'created_at', 'updated_at'
    ];
}
