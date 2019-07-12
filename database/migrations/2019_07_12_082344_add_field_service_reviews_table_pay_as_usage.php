<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldServiceReviewsTablePayAsUsage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('service_reviews', function (Blueprint $table) {
            $table->tinyInteger('pay_as_usage_type')->after('overage_price_type')->default(0)->comment('0 for off and 1 for on pay_as_usage field');
            $table->decimal('voice_usage_price',30,2)->after('pay_as_usage_type')->nullable();
            $table->decimal('data_usage_price',30,2)->after('voice_usage_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_reviews', function (Blueprint $table) {
            $table->dropColumn('pay_as_usage_type');
            $table->dropColumn('voice_usage_price');
            $table->dropColumn('data_usage_price');
        });
    }
}
