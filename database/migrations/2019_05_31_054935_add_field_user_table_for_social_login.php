<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUserTableForSocialLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->decimal('google_id',30,0)->after('id')->nullable();
           $table->decimal('facebook_id',30,0)->after('google_id')->nullable();
           $table->integer('social_login_type')->after('facebook_id')->comment('0 for normal customer 1 for google and 2 for facebook')->default(0);
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
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('social_login_type');
        });
    }
}
