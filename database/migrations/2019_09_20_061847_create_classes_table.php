<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_name');
            $table->string('local_min')->nullable();
            $table->string('local_min_start')->nullable();
            $table->string('local_min_end')->nullable();
            $table->string('data_volume')->nullable();
            $table->string('data_volume_start')->nullable();
            $table->string('data_volume_end')->nullable();
            $table->tinyInteger('type')->comment('1 for voice and 2 for data');
            $table->tinyInteger('is_active')->default(1)->comment('1 for active and 2 for inactive');
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
        Schema::dropIfExists('classes');
    }
}
