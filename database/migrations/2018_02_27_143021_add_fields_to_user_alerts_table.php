<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_alerts');
		
		Schema::create('user_alerts', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('search_string', 255)->default('');
			$table->integer('totalnumber')->default(0);
			$table->integer('totalnew')->default(0);
			$table->boolean('active')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_alerts');
    }
}
