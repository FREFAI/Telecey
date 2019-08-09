<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSuppliersAndDeviceTableDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->tinyInteger('default')->after('device_name')->default(0);
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->tinyInteger('default')->after('user_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('default');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('default');
        });
    }
}
