<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentFieldServiceRatingsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::table('service_ratings', function (Blueprint $table) {
           $table->longText('comment')->after('rating_average')->nullable();

       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::table('service_ratings', function (Blueprint $table) {
           $table->dropColumn('comment');
       });
   }
}
