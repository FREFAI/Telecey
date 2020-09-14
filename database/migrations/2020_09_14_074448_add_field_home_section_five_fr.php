<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldHomeSectionFiveFr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->text('section_five_fr')->nullable()->after('section_five');
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
            $table->dropColumn('section_five_fr');
        });
    }
}
