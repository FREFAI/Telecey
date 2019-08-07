<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndChangesFieldNameAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->tinyInteger('type')->after('id')->default(2)->comment('1 for Super admin and 2 for Subadmin');
            $table->string('lastname')->after('name')->nullable();
            $table->date('date_of_birth')->after('email')->nullable();
            $table->renameColumn('name', 'firstname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('type');
            $table->dropColumn('date_of_birth');
            $table->renameColumn('firstname', 'name');
        });
    }
}
