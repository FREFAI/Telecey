<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInServiceRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_ratings', function (Blueprint $table) {
            $table->decimal('rating_average',30,2)->after('voice_quality')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_ratings', function (Blueprint $table) {
            $table->dropColumn('rating_average');
        });
    }
}
