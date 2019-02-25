<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function($table) {
			$table->string('first_name', 255)->default('');
			$table->string('last_name', 255)->default('');
			$table->string('logo', 255)->default('');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
			$table->dropColumn('logo');
		});
    }
}
