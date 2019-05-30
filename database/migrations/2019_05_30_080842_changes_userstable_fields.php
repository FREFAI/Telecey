<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangesUserstableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstname');
            $table->string('lastname')->after('name')->nullable();
            $table->string('country')->after('lastname')->nullable();
            $table->string('city')->after('country')->nullable();
            $table->string('postal_code')->after('city')->nullable();
            $table->string('mobile_number')->after('postal_code')->nullable();
            $table->string('password_reset')->after('mobile_number')->nullable();
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
            $table->renameColumn('firstname', 'name');
            $table->dropColumn('lastname');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('mobile_number');
            $table->dropColumn('password_reset');
        });
    }
}
