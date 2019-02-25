<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
  	   $table->increments('id');
    	$table->string('name');
	   $table->text('description');
	   $table->integer('type');
	   $table->string('address');
	   $table->float('lat')->default();
	   $table->float('long')->default();
	   $table->string('streetname')->default('');
	   $table->string('streetnumber')->default('');
	   $table->string('locality')->default('');
	   $table->string('sublocality')->default('');
	   $table->string('postalcode')->default('');
	   $table->integer('location');
	   $table->string('youtube')->default('');
	   $table->string('website')->default('');
	   $table->string('phone')->default('');
	   $table->string('email')->default('');
	   $table->string('paytype');
	   $table->string('who');
	   $table->integer('status')->default(0);
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
	    Schema::dropIfExists('listings');
    }
}
