<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $Categories=['All in Real Estate',
		             'Apartments & Condos for Rent',
					 'House Rental',
					'Room Rentals & Roommates',
					'Short Term Rentals',
					'Commercial & Office Space for Rent',
					'Storage & Parking for Rent',
					'Houses for Sale',
					'Condos for Sale',
					'Land for Sale',
					'Real Estate Services',
					'MLS:registered: Listings & Home Evaluation | Listing.ca'];
	                 foreach($Categories as $value){
					     DB::table('categorylistings')->insert(['Name' => $value,]);
					 }

	$Categories=['City of Toronto', 'Markham / York Region', 'Oshawa / Durham Region', 'Mississauga / Peel Region', 'Oakville / Halton Region'];
	
	foreach($Categories as $value){
	   DB::table('locationlistings')->insert(['name' => $value]);
	}	
	
		factory(App\User::class)->create([
                    "name" => "Admin",
                    "email" => "admin@admin.com",
					"role" => 1,
                    "password" => bcrypt(env('PWD', '123456'))]
            );
     	//     $this->call(UsersTableSeeder::class);
    }
}
