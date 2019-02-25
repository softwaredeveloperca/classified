<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listings;
use Illuminate\Support\Facades\DB;
use App\Locations;
use Input;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$locations=Locations::get();
		$types=Listings::getTypes();
		$returnarray['Listings']=Listings::where('approved', 1)->orderBy('sticky', 'desc')->orderBy('created_at', 'desc')->take(3)->get();;
		$returnarray['locations']=$locations;
		$returnarray['types']=$types;
        return view('home', $returnarray);
    }
	
	public function create()
    {
        return view('create');
    }
	
	public function custom_paginator($builder, $per_page)
	{
	
		$path = \Request::route()->getName();
		$current_page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
	
		if ( ! isset($builder->getQuery()->columns[1])) $count = $builder->count();
		else
		{
			$query = clone $builder->getQuery();
			$query->columns = [ $query->columns[1] ];
			$query->orders = null;
			$count = array_get(\DB::select("select count(*) as count from ({$query->toSql()}) as haversine", $query->getBindings()), 0)->count;
		}
	
		return new \Illuminate\Pagination\LengthAwarePaginator(
			$builder->forPage($current_page, $per_page)->get(),
			$count, $per_page, null, compact('path')
		);
	}
	
	public function search(Request $request)
    {
		
        $locations=Locations::get();
		$types=Listings::getTypes();
		$returnarray['locations']=$locations;
		$returnarray['types']=$types;
		
		$params=$request->all();
		if(!isset($params['howmany']))  $params['howmany']=10;
		
		
		$returnarray['LocationID']=isset($params['location']) ? $params['location'] : 0;
		$returnarray['Type']=isset($params['offertype']) ? $params['offertype'] : 0;
		$returnarray['HowMany']=$params['howmany'] ? $params['howmany'] : 0;
		$returnarray['Address']=isset($params['address']) ? $params['address'] : '';
		$returnarray['Radius']=isset($params['radius']) ? $params['radius'] : 50;
		
		$returnarray['Bedrooms']=isset($params['bedrooms']) ? $params['bedrooms'] : 0;
		$returnarray['Bathrooms']=isset($params['bathrooms']) ? $params['bathrooms'] : 0;
		
		$returnarray['ForSaleBy']=isset($params['forsaleby']) ? $params['forsaleby'] : 0;
		$returnarray['CreatedAt']=isset($params['created_at']) ? $params['created_at'] : '';
		
		$returnarray['PriceHigh']=isset($params['pricestart']) ? $params['pricestart'] : 0;
		$returnarray['PriceLow']=isset($params['priceend']) ? $params['priceend'] : 0;
		
		$returnarray['SizeFrom']=isset($params['sizestart']) ? $params['sizestart'] : 0;
		$returnarray['SizeTo']=isset($params['sizeend']) ? $params['sizeend'] : 0;
		
		$returnarray['ListingType']=isset($params['listingtype']) ? $params['listingtype'] : 0;
		
		$returnarray['Parking']=isset($params['parking']) ? $params['parking'] : 0;
		$returnarray['Storage']=isset($params['storage']) ? $params['storage'] : 0;
		$returnarray['PetFriendly']=isset($params['petfriendly']) ? $params['petfriendly'] : 0;
		$returnarray['Furnished']=isset($params['furnished']) ? $params['furnished'] : 0;
			
		
		$params['Lat']=0;
		$params['Long']=0;
		if($returnarray['Address'] != '') 
		{ 
			$geodata=Locations::getLocationData($returnarray['Address']);
			
			$params['Lat']=$geodata['latitude'];
			$params['Long']=$geodata['longitude'];

		}

		
		$listing=new Listings;
		
		
		$listings=$listing->search($returnarray['LocationID'],$returnarray['Type'],$params['Lat'], $params['Long'], $returnarray['Radius'], $returnarray['Bedrooms'], $returnarray['Bathrooms'], $returnarray['ForSaleBy'], $returnarray['PriceLow'], $returnarray['PriceHigh'], $returnarray['SizeFrom'], $returnarray['SizeTo'], $returnarray['ListingType'], $returnarray['CreatedAt'], $returnarray['Parking'], $returnarray['Storage'], $returnarray['PetFriendly'], $returnarray['Furnished'])->orderBy('sticky', 'desc')->has('Location');
		
		//$new_listings=[];
		foreach($listings as $listing)
		{
		//	$listing->created_at=$listing->created_at->diffForHumans();
			//array_push($new_listings, $listing);
		}
	//	$listings=$new_listings;
		//->paginate( $returnarray['HowMany']);
		$listings=$this->custom_paginator($listings, $returnarray['HowMany']);
		
	
		
		//$listings=$listing->search($returnarray['LocationID'],$returnarray['Type'],$params['Lat'], $params['Long'])->toSql();
		//->paginate( $returnarray['HowMany'] );
		//dd($listings);
		
		
		
	
		$returnarray['Listings']=$listings->appends(Input::except('page'));
        return view('search', $returnarray);
    }
	
	public function sendContact(Request $request, $id)
	{
		//$listing=Listings::where('id', $id)->first()->toArray();
		
		//$returnarray['Listing']=$listing;
		$listings=new Listings;
		$listings->sendComment($id, $request);
		
		return redirect('/listing/' . $id)->with('status', 'Your message has been sent');
		
	
	}
	
	public function viewlisting($id)
	{
		$listing=Listings::where('id', $id)->where('approved', 1)->first()->toArray();
		
		$returnarray['Listing']=$listing;
		
		return view('viewlisting', $returnarray);
	}
}
