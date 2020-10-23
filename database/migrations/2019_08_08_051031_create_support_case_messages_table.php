<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportCaseMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_case_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sender_id')->default(0);
            $table->integer('receiver_id')->default(0);
            $table->integer('case_id')->default(0);
            $table->text('message')->nullable();
            $table->tinyInteger('is_read')->default(0)->comment('0 for unread and 1 for read');
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
        Schema::dropIfExists('support_case_messages');
    }
}
