<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSettingTableTermsCondition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('setting_preferences', function (Blueprint $table) {
            $table->text('terms_and_conditions')->nullable()->after('no_search_message');
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
            $table->dropColumn('terms_and_conditions');
        });
    }
}
