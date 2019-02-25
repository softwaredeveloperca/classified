<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Listings;
use App\Locations;
use App\Mail\AlertFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Alerts extends Model
{
    protected $table = 'user_alerts';
	protected $guarded = [];
	
	 public static function parseSearchString($string)
	 {
		 $nstring=$string;
		parse_str($nstring, $output);
		$new_string=array();

		$location=isset($output['location'])?intval($output['location']):0;
			$type=isset($output['type'])?intval($output['type']):0;
			$radius=isset($output['radius'])?intval($output['radius']):0;
			$forsaleby=isset($output['forsaleby'])?intval($output['forsaleby']):0;
			$bathrooms=isset($output['bathrooms'])?intval($output['bathrooms']):'';
			$bedrooms=isset($output['bedrooms'])?intval($output['bedrooms']):'';
			$pricestart=isset($output['pricestart'])?intval($output['pricestart']):0;
			$priceend=isset($output['priceend'])?intval($output['priceend']):0;
			$sizestart=isset($output['sizestart'])?intval($output['sizestart']):0;
			$sizeend=isset($output['sizeend'])?intval($output['sizeend']):0;
			$listingtype=isset($output['listingtype'])?intval($output['listingtype']):0;
			
		if($location > 0)
		{
			$name=Listings::getLocationName($location);
		
			$new_string[]=$name->name . "";
		
			
		}
	
		
			
		if($listingtype > 0)
		{
			$name=Listings::getCategory($listingtype);
			//dd($name);
			$new_string[]=$name->name . "";
			
		}
	
		if($bathrooms > '')
		{
			$arr=explode(",", $bathrooms);

			
			if(in_array(1, $arr))  $new_string[]="Bathrooms";
			if(in_array(2, $arr))  $new_string[]="1 bathroom";
			if(in_array(3, $arr))  $new_string[]="1.5 bathrooms";
			if(in_array(4, $arr))  $new_string[]="2 bathrooms";
			if(in_array(5, $arr))  $new_string[]="2.5 1 bathrooms";
			if(in_array(6, $arr))  $new_string[]="3 bathrooms";
			if(in_array(7, $arr))  $new_string[]="3.5 1 bathrooms";
			if(in_array(8, $arr))  $new_string[]="4 bathrooms";
			if(in_array(8, $arr))  $new_string[]="4.5 bathrooms";
			if(in_array(9, $arr))  $new_string[]="5 bathrooms";
			if(in_array(10, $arr))  $new_string[]="5.5 bathrooms";
			if(in_array(11, $arr))  $new_string[]="6 or more bathrooms";
			
			
			
		}
		if($bedrooms > '')
		{
			$arr=explode(",", $bedrooms);
			
			if(in_array(1, $arr))  $new_string[]="Bachelor or studio";
			if(in_array(2, $arr))  $new_string[]="1 bedroom";
			if(in_array(3, $arr))  $new_string[]="1 bedroom and den";
			if(in_array(4, $arr))  $new_string[]="2 bedrooms";
			if(in_array(5, $arr))  $new_string[]="2 bedrooms and den";
			if(in_array(6, $arr))  $new_string[]="3 bedrooms";
			if(in_array(7, $arr))  $new_string[]="4 bedrooms";
			if(in_array(8, $arr))  $new_string[]="5 bedrooms";
			if(in_array(8, $arr))  $new_string[]="6 or more bedrooms";
			
			
			
		}
		if($type > 0)
		{
			switch ($forsaleby)
			{
				case 1:
					$new_string[]="Offering";
				break;
				case 2:
					$new_string[]="Wanting";
				break;
				
			}
	
			
		}
		if($forsaleby > 0)
		{
			switch ($forsaleby)
			{
				case 1:
					$new_string[]="Owner";
				break;
				case 2:
					$new_string[]="Professional";
				break;
				
			}
		
			
		}
		
		if($sizeend > 0)
		{
			$new_string[]="Size from: " . $sizestart . ' to ' . $sizeend . " (sqft)";
			
		}
		if($priceend > 0)
		{
			$new_string[]="Price from: $" . $pricestart . ' to $' .  $priceend . "";
			
		}
//		$id=rand(11111,66666);
//		$new_string.='<a id="moreParamslink-' . $id . '" class="moreParamslink" href="#">more?</a> <div style="display: none;" id=//"moreParams-' . $id . '">' . $string . '</div>';
		
		return implode(", ", $new_string); 
	 }
	
	public static function checkAlerts($id=0){
		$Alerts=Alerts::orderby('created_at')->with('user')->orderBy('created_at')->get();
		
		$returnarray=[];
		$listemails=[];
		foreach($Alerts as $Alert)
		{
			
			parse_str($Alert->search_string, $output);
			
			
		
			$location=isset($output['location'])?intval($output['location']):0;
			$type=isset($output['type'])?intval($output['type']):0;
			$radius=isset($output['radius'])?intval($output['radius']):0;
			$forsaleby=isset($output['forsaleby'])?intval($output['forsaleby']):0;
			$bathrooms=isset($output['bathrooms'])?intval($output['bathrooms']):'';
			$bedrooms=isset($output['bedrooms'])?intval($output['bedrooms']):'';
			$pricestart=isset($output['pricestart'])?intval($output['pricestart']):0;
			$priceend=isset($output['priceend'])?intval($output['priceend']):0;
			$sizestart=isset($output['sizestart'])?intval($output['sizestart']):0;
			$sizeend=isset($output['sizeend'])?intval($output['sizeend']):0;
			$listingtype=isset($output['listingtype'])?intval($output['listingtype']):0;
	
			
			$listing=new Listings;
			if(!empty($address)){
				$geodata=Locations::getLocationData($address);
				
				$lat=$geodata['latitude'];
				$lng=$geodata['longitude'];
			}
			else {
				$lat=0;
				$lng=0;
			}
			$newitems=$listing->search($location, $type, $lat, $lng, $radius, $bedrooms, $bathrooms, $forsaleby, $pricestart, $priceend, $sizestart, $sizeend, $listingtype, isset($Alert->created_at)?$Alert->created_at:'')->count();
			
			$items=$listing->search($location, $type, $lat, $lng, $radius, $bedrooms, $bathrooms, $forsaleby, $pricestart, $priceend, $sizestart, $sizeend, $listingtype)->count();
			
			if(isset($Alert->user)) {
				$temparray=[];
				//$Alert->user->email;
				$Alert->totalnumber=$items;
				$Alert->totalnew=$newitems;
				$Alert->save();
		
				$temparray['email']=$Alert->user->email;
				$temparray['name']=$Alert->user->first_name . ' ' . $Alert->user->last_name;
				$temparray['items']=$items;
				$temparray['user']=$Alert->user;
				$temparray['listingtype']=isset($listingtype)?:0;
				$temparray['created_at']=$Alert->created_at;
				$temparray['newitems']=$newitems;
				$returnarray[$Alert->id]=$temparray;
				
				if(!isset($listemails[$Alert->user->email]))
					Mail::to($Alert->user)->send(new AlertFound());	
				$listemails[$Alert->user->email]=$temparray;
				unset($temparray);
				
				Mail::to($Alert->user)->send(new AlertFound());	
			
			}
		}
		foreach($listemails as $key => $listemail)
		{
		
		
		//	if($key != '')
				//Mail::to($listemail['email'])->send(new AlertFound($listemail['name']));	
		}
		
		return $returnarray;
	}
	
	public function user()
	{
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
