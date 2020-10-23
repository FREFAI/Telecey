<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryCodeToDeviceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_reviews', function (Blueprint $table) {
            $table->string('country_code')->nullable()->after('storage');
            $table->decimal('latitude')->nullable()->after('storage');
            $table->decimal('longitude')->nullable()->after('storage');
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
            //
        });
    }
}
