<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldHomeContentTableSection4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->string('section_four')->after('section_three')->nullable();
            $table->string('section_four_image')->after('section_four')->nullable();
            $table->longText('section_four_description')->after('section_four_image')->nullable();
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
            $table->dropColumn('section_four');
            $table->dropColumn('section_four_image');
            $table->dropColumn('section_four_description');
        });
    }
}
