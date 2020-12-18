<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInSettingsTableFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->tinyInteger('feedback_feature')->default(0)->after('blog_image_limit')->comment('1 for enable 0 for disable');
            $table->string('feedback_title')->nullable()->after('feedback_feature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->dropColumn('feedback_feature');
            $table->dropColumn('feedback_title');
        });
    }
}
