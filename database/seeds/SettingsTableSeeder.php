<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");

        DB::table("setting_preferences")->insert([
            [
                'device'=> 1,
                'personal_business_setting'=> 1,
                'postpaid_prepaid_setting'=> 1,
                'mobile_home_setting'=> 1,
                'unlimited_calls_setting'=> 1,
                'gb_setting'=> 1,
                'mb_setting'=> 1,
                "created_at" => $now,
                "updated_at" => $now,
            ]
        ]);
    }
}
