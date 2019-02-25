<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    //
	
	protected $table = 'locationlistings';
	protected $guarded = [];
	
	public static function getLocationData($AddressText)
	{
		$locationdata=app('geocoder')->geocode($AddressText . ', Canada')->get();	
		$location=$locationdata[0]->toArray();
		return $location;
	}
	
}
