<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldHomeTableImageLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('home_contents', function (Blueprint $table) {
            $table->string('section_one_image_link')->nullable()->after('section_one_image');
            $table->string('section_four_image_link')->nullable()->after('section_four_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('home_contents', function (Blueprint $table) {
            $table->dropColumn('section_one_image');
            $table->dropColumn('section_four_image');
        });
    }
}
