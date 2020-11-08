<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildInServiceReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_reviews', function (Blueprint $table) {
            $table->string('speed')->after('voice_price')->nullable();
            $table->string('upfront_price')->nullable()->change();
            $table->string('datavolume')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_reviews', function (Blueprint $table) {
            $table->dropColumn('speed');
        });
    }
}
