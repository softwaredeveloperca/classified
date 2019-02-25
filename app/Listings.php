<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Categories;
use App\Locations;
use App\User;

use App\Mail\sendComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class Listings extends Model
{
     protected $guarded = ['id'];
	 
	 
	 public function sendComment($id, $data)
	 {
	
		 	$data['comment']=$data->input('comment');
	
		  $listing=Listings::where('id', $id)->with('User')->first();
		  $data['listing']=$listing;
		  $data['data']=$data;
	
		
		 Mail::to($listing->user)->send(new sendComment($data));
	 }	
	 
	 public function user()
	 {
		// return $this->belongsTo('App\User', "id", "who"));
		 return $this->hasOne('App\User', "id", "who");
	 }
	 
	

	
	 
	 
	 
	 public function search($LocationID=0, $Type=0, $lat=0, $lng=0, $radius=1, $Bedrooms=0, $Bathrooms=0, $ForSaleBy=0, $PriceLow=0, $PriceHigh=0, $SizeFrom=0, $SizeTo=0, $ListingType=0, $created_at='', $Parking=0, $Storage=0, $PetFriendly=0, $Furnished=0)
	 {


			 
		return $this
				->WithApproved()
				->WithParking($Parking)
				->WithStorage($Storage)
				->WithPetFriendly($PetFriendly)
				->WithFurnished($Furnished)	
		 		->WithRegions($LocationID)
				->WithType($Type)
				->WithDistance($lat, $lng, $radius)
				->WithBedrooms($Bedrooms)
				->WithBathrooms($Bathrooms)
				->WithForSaleBy($ForSaleBy)
				->WithPrice($PriceHigh, $PriceLow)
				->WithSize($SizeFrom, $SizeTo)
				->WithListingType($ListingType)
				->WithCreatedAt($created_at)
				;
		// }
	 }
	 
	public function scopeWithParking($query, $Data)
	{
		if($Data == 1) return $query->where('parking',  '=', 1);
		return $query;
	}
	
	public function scopeWithStorage($query, $Data)
	{
		if($Data == 1) return $query->where('storage',  '=', 1);
		return $query;
	}
	
	public function scopeWithPetFriendly($query, $Data)
	{
		if($Data == 1) return $query->where('petfriendly',  '=', 1);
		return $query;
	}
	
	public function scopeWithFurnished($query, $Data)
	{
		if($Data == 1) return $query->where('furnished',  '=', 1);
		return $query;
	}
	 
	public function Location()
	{
		return $this->hasOne('App\Locations', 'id', 'location');
	}
	
	public function Category()
	{
		return $this->hasOne('App\Categories', 'id', 'listingtype');
	}
	 
	 public function scopeWithApproved($query)
	 {
		  return $query->where('approved',  '=', 1);
		  //->with("Locations;
	 }
	  public function scopeWithCreatedAt( $query, $created_at = '' ) {
		
		if($created_at != '')
	     return $query->where('created_at',  '>', $created_at);
		 
		return $query;
	}
	
	   public function scopeWithBedrooms( $query, $Data = '' ) {
		
		if($Data != '')
	     return $query->where('bedrooms',  explode(",", $Data));
	
		return $query;
	}
	 
	   public function scopeWithBathrooms( $query, $Data = '' ) {
		
		
		if($Data != '')
	     return $query->whereIn('bathrooms',  explode(",", $Data));
		 	
		return $query;
	}
	 
	  public function scopeWithForSaleBy( $query, $Data = 0 ) {
		
		if($Data > 0)
	     return $query->where('forsaleby', '=', $Data);
		
		return $query;
	}
	 
	 public function scopeWithPrice( $query, $Data1 = 0 , $Data2 = 0) {
		
		if($Data2 > 0)
	     return $query
		 	->where('price', '>=', $Data1)
			->where('price', '<=', $Data2);
			
			
		return $query;
	}
	 
	 
	  public function scopeWithSize( $query, $Data1 = 0 , $Data2 = 0) {
		
		if($Data2 > 0)
	     return $query
		 	->where('size', '>=', $Data1)
			->where('size', '<=', $Data2);
		return $query;
	}
	 
	 
	 public function scopeWithListingType( $query, $Type = 0 ) {
		
		
		if($Type > 1)
	     return $query->where('listingtype', '=', $Type);
		 
		return $query;
	}
	 
	 public function scopeWithRegions( $query, $LocationID = 0 ) {
		
		if($LocationID > 0)
	     return $query->where('location', '=', $LocationID);
		return $query;
	}
	
	 public function scopeWithType( $query, $Type = 0 ) {
		
		if($Type > 0)
	     return $query->where('type', '=', $Type);
		return $query;
	}
	
	public function scopeWithDistance($query, $lat, $lng, $radius, $unit = "km")
	{
	
	
		if($lat == 0) return $query;
		$unit = ($unit === "km") ? 6378.10 : 3963.17;
		$lat = (double) $lat;
		$lng = (double) $lng;
		$radius = (double) $radius;
		
		

    $haversine = "($unit * ACOS(COS(RADIANS($lat))
									* COS(RADIANS(lat))
									* COS(RADIANS($lng) - RADIANS(`long`))
									+ SIN(RADIANS($lat))
									* SIN(RADIANS(lat))))";

    return $query
        ->selectRaw("*, {$haversine} AS distance")

        ->orderBy('sticky', 'desc')
		->orderBy('distance', 'asc')
        ->whereRaw("{$haversine} < ?", [$radius]);
		
		/*
		$q=$query->select(DB::raw("*,
								($unit * ACOS(COS(RADIANS($lat))
									* COS(RADIANS(lat))
									* COS(RADIANS($lng) - RADIANS(`long`))
									+ SIN(RADIANS($lat))
									* SIN(RADIANS(lat)))) AS distance")
					)->having( 'distance', '<=', $radius )->orderBy('distance','asc');
			
					return $q;
					*/
	}
	
	 public function addressSearch( $Address = '', $params) {
		// $Lat, $Long, $Distance, $Limit 
		$Distance=$params['radius'];
		$Lat=$params['Lat'];
		$Long=$params['Long'];
		
		return DB::select(DB::raw('SELECT id, name, description, photo1, address, lat,`long`,  ( 3959 * acos( cos( radians(' . $Lat . ') ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians(' . $Long . ') ) + sin( radians(' . $Lat .') ) * sin( radians(lat) ) ) ) AS distance FROM listings having distance < ' . $Distance . ' ORDER BY distance') );

	}
	
	public static function getTypes()
	{
		$cl=\DB::table('categorylistings')->orderby('id')->get();
		return $cl;
	}
	
	public static function getCategory($id)
	{
		$cl=\DB::table('categorylistings')->where('id', $id)->first();
		return $cl;
	}
	
	public static function getLocationName($id)
	{
		$cl=\DB::table('locationlistings')->where('id', $id)->first();
		return $cl;
	}
	
	
	
	
	 
}
