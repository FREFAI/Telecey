<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->integer('personal_business_setting')->after('device')->comment('1 for show 0 for hide')->default(1);
            $table->integer('postpaid_prepaid_setting')->after('personal_business_setting')->comment('1 for show 0 for hide')->default(1);
            $table->integer('mobile_home_setting')->after('postpaid_prepaid_setting')->comment('1 for show 0 for hide')->default(1);
            $table->integer('unlimited_calls_setting')->after('mobile_home_setting')->comment('1 for show 0 for hide')->default(1);
            $table->integer('gb_setting')->after('unlimited_calls_setting')->comment('1 for show 0 for hide')->default(1);
            $table->integer('mb_setting')->after('gb_setting')->comment('1 for show 0 for hide')->default(1);
            $table->integer('device')->comment('1 for show 0 for hide')->default(1)->change();
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
            $table->dropColumn('personal_business_setting');
            $table->dropColumn('postpaid_prepaid_setting');
            $table->dropColumn('mobile_home_setting');
            $table->dropColumn('unlimited_calls_setting');
            $table->dropColumn('gb_setting');
            $table->dropColumn('mb_setting');
        });
    }
}
