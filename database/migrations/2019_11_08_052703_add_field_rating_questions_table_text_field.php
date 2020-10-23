<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldRatingQuestionsTableTextField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rating_questions', function (Blueprint $table) {
            $table->tinyInteger('text_field')->default(0)->after('type')->comment('1 for Text field add in rating section and 0 for no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rating_questions', function (Blueprint $table) {
            $table->dropColumn('text_field');
        });
    }
}
