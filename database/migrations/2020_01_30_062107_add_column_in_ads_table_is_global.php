<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInAdsTableIsGlobal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->tinyInteger('is_global')->default(1)->after('type');
            $table->tinyInteger('country')->nullable()->after('is_global');
            $table->integer('is_active')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('is_global');
            $table->dropColumn('country');
            $table->integer('is_active')->default(1)->change();
        });
    }
}
