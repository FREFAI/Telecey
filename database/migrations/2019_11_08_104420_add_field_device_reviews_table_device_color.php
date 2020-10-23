<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDeviceReviewsTableDeviceColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_reviews', function (Blueprint $table) {
            $table->integer('device_color')->nullable()->after('supplier_id');
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
            $table->dropColumn('device_color');
        });
    }
}
