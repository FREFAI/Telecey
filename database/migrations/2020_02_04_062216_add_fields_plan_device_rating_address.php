<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsPlanDeviceRatingAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_device_rating', function (Blueprint $table) {
            $table->text('address')->nullable()->after('average');
            $table->string('country')->nullable()->after('address');
            $table->string('city')->nullable()->after('country');
            $table->decimal('longitude')->nullable()->after('city');
            $table->decimal('latitude')->nullable()->after('longitude');
            $table->string('postal_code')->nullable()->after('latitude');
            $table->text('formatted_address')->nullable()->after('postal_code');
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
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
            $table->dropColumn('postal_code');
            $table->dropColumn('formatted_address');
        });
    }
}
