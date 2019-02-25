<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Listings::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
		'description' => $faker->description,
		'type' => realText($faker->numberBetween(1,2)),
		'address' => $faker->streetAddress,
		'lat' => realText($faker->numberBetween(43.00,44.00)),
		'long' => realText($faker->numberBetween(-79.00,-80.00)),   
		'streetname' => $faker->name,
		'streetnumber' => realText($faker->numberBetween(1,3000)), 
		'location' => realText($faker->numberBetween(1,5)), 
		'youtube' => $faker->name, 
		'website' => $faker->name, 
		'who' => 2, 
		'status' => 1, 
		'photo1' => $faker->image('public/images/listings',null, null, null, false), 
		'photo2' => $faker->image('public/images/listings',null,null, null, false), 
		'photo3' => $faker->image('public/images/listings',null,null, null, false), 
		'photo4' => $faker->image('public/images/listings',null,null, null, false), 
		'listingtype' => realText($faker->numberBetween(1,12)), 
		'forsaleby' => realText($faker->numberBetween(1,2)), 
		'bathrooms' => realText($faker->numberBetween(1,9)), 
		'bedrooms' => realText($faker->numberBetween(1,9)),
		'price' => realText($faker->numberBetween(10000,100000)),
		'size' => realText($faker->numberBetween(1000,3000)),
	
    ];
});
