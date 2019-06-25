<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoFieldServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_reviews', function (Blueprint $table) {
           $table->decimal('voice_price',30,2)->after('price')->nullable();
           $table->decimal('data_price',30,2)->after('voice_price')->nullable();
           $table->integer('overage_price_type')->after('data_price')->default(0)->comment('0 for no and 1 for yes');

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
           $table->dropColumn('voice_price');
           $table->dropColumn('data_price');
           $table->dropColumn('overage_price_type');
       });
    }
}
