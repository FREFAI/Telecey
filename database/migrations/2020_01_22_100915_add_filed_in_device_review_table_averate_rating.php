<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledInDeviceReviewTableAverateRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_reviews', function (Blueprint $table) {
            $table->decimal('average_review',30,2)->after('country_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_reviews', function (Blueprint $table) {
            $table->dropColumn('average_review');
        });
    }
}
