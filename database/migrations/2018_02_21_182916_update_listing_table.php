<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('listings', function($table) {
			$table->string('photo1', 255)->default('');
			$table->string('photo2', 255)->default('');
			$table->string('photo3', 255)->default('');
			$table->string('photo4', 255)->default('');
			$table->string('photo5', 255)->default('');
			$table->string('photo6', 255)->default('');
			$table->string('photo7', 255)->default('');
			$table->string('photo8', 255)->default('');
			$table->string('photo9', 255)->default('');
			
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function($table) {
			$table->dropColumn('photo1');
			$table->dropColumn('photo2');
			$table->dropColumn('photo3');
			$table->dropColumn('photo4');
			$table->dropColumn('photo5');
			$table->dropColumn('photo6');
			$table->dropColumn('photo7');
			$table->dropColumn('photo8');
			$table->dropColumn('photo9');
		});
    }
}
