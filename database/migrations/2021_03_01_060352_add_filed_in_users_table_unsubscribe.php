<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledInUsersTableUnsubscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('is_subscribed')->after('email_verified_at')->default(1)->comment('1 for subscribed 0 for unsubscribed');
            $table->text("unsubscribe_reason")->after('is_subscribed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_subscribed');
            $table->dropColumn('unsubscribe_reason');
        });
    }
}
