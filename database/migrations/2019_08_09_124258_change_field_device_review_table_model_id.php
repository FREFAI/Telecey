<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldDeviceReviewTableModelId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_reviews', function (Blueprint $table) {
            $table->renameColumn('model_id','supplier_id');
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
            $table->renameColumn('supplier_id','model_id');
        });
    }
}
