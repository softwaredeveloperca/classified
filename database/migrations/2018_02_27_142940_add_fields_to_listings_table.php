<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function($table) {
			$table->integer('forsaleby')->default(0);
			$table->string('bathrooms', 255)->default('');
			$table->string('bedrooms', 255)->default('');
			$table->integer('price')->default(0);
			$table->integer('size')->default(0);

			
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
			$table->dropColumn('firsaleby');
			$table->dropColumn('bathrooms');
			$table->dropColumn('bedrooms');
			$table->dropColumn('price');
			$table->dropColumn('size');

		});
    }
}
