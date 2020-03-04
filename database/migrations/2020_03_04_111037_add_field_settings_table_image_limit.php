<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSettingsTableImageLimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_preferences', function (Blueprint $table) {
            $table->decimal('homepage_images_limit')->default(10)->after('no_of_search_record')->comment('Limit in MB');
            $table->decimal('blog_image_limit')->default(10)->after('homepage_images_limit')->comment('Limit in MB');
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
            $table->dropColumn('homepage_images_limit');
            $table->dropColumn('blog_image_limit');
        });
    }
}
