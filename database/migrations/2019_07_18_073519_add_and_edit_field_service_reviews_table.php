<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndEditFieldServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_reviews', function (Blueprint $table) {
            $table->decimal('uploading_speed',30,2)->after('data_speed')->nullable();
            $table->tinyInteger('speedtest_type')->after('uploading_speed')->default(0);
            $table->renameColumn('data_speed', 'downloading_speed');
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
            $table->dropColumn('uploading_speed');
            $table->dropColumn('speedtest_type');
            $table->renameColumn('downloading_speed', 'data_speed');
        });
    }
}
