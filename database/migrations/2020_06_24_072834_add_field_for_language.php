<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldForLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->longText('section_one_fr')->nullable()->after('section_one');
            $table->longText('section_two_fr')->nullable()->after('section_two');
            $table->longText('section_three_fr')->nullable()->after('section_three');
            $table->longText('section_four_fr')->nullable()->after('section_four');
            $table->longText('section_four_description_fr')->nullable()->after('section_four_description');
            $table->longText('section_six_fr')->nullable()->after('section_six');
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
            $table->dropColumn('section_one_fr');
            $table->dropColumn('section_two_fr');
            $table->dropColumn('section_three_fr');
            $table->dropColumn('section_four_fr');
            $table->dropColumn('section_four_description_fr');
            $table->dropColumn('section_six_fr');
        });
    }
}
