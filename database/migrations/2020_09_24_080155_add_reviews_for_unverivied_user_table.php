<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewsForUnveriviedUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->tinyInteger('reviews_for_unverified')->default(0)->after('personal_business_setting');
            $table->tinyInteger('review_detail_for_unverified')->default(0)->after('reviews_for_unverified');
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
           $table->dropColumn('reviews_for_unverified');
           $table->dropColumn('review_detail_for_unverified');
        });
    }
}
