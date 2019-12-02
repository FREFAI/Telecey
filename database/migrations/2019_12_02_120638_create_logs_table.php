<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->tinyInteger('log_type')->nullable()->comment('1 for signup, 2 for email verification, 3 for login user,4 for search device, 5 for search plans, 6 for message');
            $table->tinyInteger('login_signup_type')->nullable()->comment('1 for normal 2 for facebook and 3 for google');
            $table->tinyInteger('type')->nullable()->comment('1 for admin and 2 for user');
            $table->string('ip')->nullable();
            $table->tinyInteger('user_status')->nullable()->comment('1 for active 0 for in-active');
            $table->string('user_name')->nullable();
            $table->string('user_number')->nullable();
            $table->string('email')->nullable();
            $table->longText('filter_params')->nullable();
            $table->tinyInteger('filter_type')->nullable()->comment('1 for plan and 2 for device');
            $table->integer('filter_search_result_count')->nullable();
            $table->tinyInteger('request_type')->nullable()->comment('');
            $table->string('reuqest_param_name')->nullable();
            $table->tinyInteger('appr_disapp_status')->nullable()->comment('1 for approved 0 for disapproved');
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
        Schema::dropIfExists('logs');
    }
}
