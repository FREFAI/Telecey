<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $table = 'setting_preferences';
    protected $guard = 'admin';

    protected $fillable = [
        'setting_key','feedback_feature','feedback_title','display_price','terms_and_conditions','privacy_policy','cookie_policy','reviews_for_unverified','review_detail_for_unverified', 'status','disable_price_for_logged_out_users','disable_details_for_logged_out_users','no_of_search_record','homepage_images_limit','blog_image_limit'
    ];
}
