<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('provider_name')->nullable();
            $table->integer('contract_type')->comment('1 for personal and 2 for business contract type');
            $table->decimal('price',30,2)->default(0);
            $table->string('payment_type')->nullable();
            $table->string('service_type')->nullable();
            $table->string('local_min')->nullable();
            $table->string('datavolume')->nullable();
            $table->string('long_distance_min')->nullable();
            $table->string('international_min')->nullable();
            $table->string('roaming_min')->nullable();
            $table->string('data_speed')->nullable();
            $table->string('sms')->nullable();
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
        Schema::dropIfExists('service_reviews');
    }
}
