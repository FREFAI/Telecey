<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('service_id');
            $table->decimal('coverage',5,1)->default(0);
            $table->decimal('service_stability',5,1)->default(0);
            $table->decimal('billing_payment',5,1)->default(0);
            $table->decimal('data_speed',5,1)->default(0);
            $table->decimal('service_waiting',5,1)->default(0);
            $table->decimal('voice_quality',5,1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_ratings');
    }
}
