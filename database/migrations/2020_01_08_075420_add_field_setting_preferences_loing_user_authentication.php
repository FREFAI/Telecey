<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSettingPreferencesLoingUserAuthentication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->tinyInteger('disable_price_for_logged_out_users')->nullable()->default(1)->after('terms_and_conditions');
            $table->tinyInteger('disable_details_for_logged_out_users')->nullable()->default(1)->after('disable_price_for_logged_out_users');
            $table->integer('no_of_search_record')->nullable()->default(0)->after('disable_details_for_logged_out_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->dropColumn('disable_price_for_logged_out_users');
            $table->dropColumn('disable_details_for_logged_out_users');
            $table->dropColumn('no_of_search_record');
        });
    }
}
