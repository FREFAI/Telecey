<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldPlanDeviceRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_device_rating', function (Blueprint $table) {
            $table->integer('device_id')->after('plan_id')->default(0);
            $table->integer('plan_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_device_rating', function (Blueprint $table) {
            $table->dropColumn('device_id');
        });
    }
}
