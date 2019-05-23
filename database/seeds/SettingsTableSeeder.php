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
                "created_at" => $now,
                "updated_at" => $now,
            ]
        ]);
    }
}
