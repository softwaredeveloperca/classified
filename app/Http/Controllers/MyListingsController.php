<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestF;
use Auth;
use Input;
use App\User;
use App\Listings;
use App\Alerts;
use App\Locations as Locations;
//use Spatie\Geocoder;


class MyListingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function addalert(Request $request)
	{
		//print "okay";
		$items=explode("?", $request->fullUrl());
	
		$str=join('&', $request->all());
		
		Alerts::create(["user_id" => Auth::user()->id, 'search_string' =>  $items[1]]);
		
	}
    public function index()
    {
		$locations=Locations::get();
		$listingtypes=Listings::getTypes();
		$returnarray['listingtypes']=$listingtypes;
		
		$returnarray['locations']=$locations;
        return view('create', $returnarray);
    }
	
	public function deleteListing($id)
	{
		$delete=Listings::where('user_id', Auth::user()->id)->where('id', $id)->delete();
		
		$listings=Listings::where('who', Auth::user()->id)->orderBy('created_at', "desc")->get();
		$returnarray['Listings']=$listings;
		return view('mylistings', $returnarray);
		
	}

    public function mylistings()
	{
		$listings=Listings::where('who', Auth::user()->id)->orderBy('created_at', "desc")->get();
		$returnarray['Listings']=$listings;
	
		return view('mylistings', $returnarray);
		
	}
	
	public function myalerts()
	{
		
		$alerts=Alerts::where('user_id', Auth::user()->id)->orderBy('created_at', "desc")->get();
		$new_alerts=[];
		foreach($alerts as $alert)
		{
	
			$alert->new_search_string=Alerts::parseSearchString($alert->search_string);
			$new_alerts[]=$alert;

		}
	
		$returnarray['Alerts']=$new_alerts;
		return view('myalerts', $returnarray);
		
	}
	
	public function deleteAlert($id)
	{
		Alerts::where('user_id', Auth::user()->id)->where('id', $id)->delete();
	}
	
	public function editAlert($id)
	{
		$alert=Listings::where('user_id', Auth::user()->id)->where('id', $id)->get();
		if(!$alert) return redirect()->route('myalerts')->with('status', 'Alert not found.');

		$returnarray['Alert']=$alert;

		return view('alert', $returnarray);
		
		
	}
	
	public function editListing($id)
	{
		$listing=Listings::where('who', Auth::user()->id)->where('id', $id)->first();
		if(!$listing) return redirect()->route('mylistings')->with('status', 'Listing not found.');
		$locations=Locations::get();
	
		$listingtypes=Listings::getTypes();
	
		
		$returnarray['listing']=$listing;
		$returnarray['locations']=$locations;
		$returnarray['id']=$id;
		$listingtypes=Listings::getTypes();
		$returnarray['listingtypes']=$listingtypes;
		
		return view('create', $returnarray);
		
		
	}
	
	public function myaccount()
	{
		$user=User::where('id', Auth::user()->id)->first();
		$returnarray['user']=$user;
		return view('myaccount', $returnarray);
	}
	
	public function myaccountsave(Request $request)
	{
		
		$validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
			
      ]);
	  
	//  $logo='';
	 // if( $request->hasFile('logo') ) $logo=$request->logo->store('storage/uploads');
	 
	 if(Input::get('password') != '' && (Input::get('password') == Input::get('password2')))
			{
				$data['password']=bcrypt(Input::get('password'));
				
				 User::where('id', Auth::user()->id)->update([
            'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
		'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
        ]);
			}
			else {
 

    
        User::where('id', Auth::user()->id)->update([
            'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
	
            'email' => $request->input('email'),
        ]);
	
			}
		
		
		return redirect()->route('myaccount')->with('status', 'Profile updated!');
	}
	
	public function alertsadd(Request $request)
	{
		//
	}
	
	public function store(Request $request)
    {
		
	
		$validatedData = $request->validate([
        	'title' => 'required|max:255',
        	'description' => 'required|max:10000', 
			'address' => 'required|max:255',
			'forsaleby' => 'required',
			'photo1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo6' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo7' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo8' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'photo9' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	]);
		
		
		$geodata=Locations::getLocationData($request->input('address'));
		//dd($geodata);
		


		if(!empty($request->input('id')) && $request->input('id') > 0 ){
			$listing=Listings::where('who', Auth::user()->id)->where('id', $request->input('id'))->first();
		}
		$destinationPath='images/listings/';
						
		for($x=1; $x<10; $x++)
		{
	
			
			if(isset($listing->{"photo".$x}))
			{
				${"photo".$x}=$listing->{"photo".$x};
			}
			else {
				${"photo".$x}='';
			}
			if (RequestF::hasFile('photo'.$x))
			{
		

			if (Input::file('photo'.$x)->isValid()) {
			


					$extension = Input::file('photo'.$x)->getClientOriginalExtension(); // getting image extension
					$fileName = rand(111111111,999999999).'.'.$extension; // renameing image
					//$aimage=$admin->resize(Input::file('image_'.$x), $fileName, 300);	
					Input::file('photo'.$x)->move($destinationPath, $fileName); 
					${"photo".$x}=$fileName;
				}
			}
			
			
		}
		

		$parking=0;
		$storage=0;
		$furnished=0;
		$petfriendly=0;
		if($request->input('parking') !== null && $request->input('parking') == 1){ $parking=1; }
		if($request->input('parking') !== null && $request->input('parking') == 2){ $storage=1; }
		
		if($request->input('furnished') !== null && $request->input('furnished') == 1){ $furnished=1; }
		if($request->input('petfriendly') !== null && $request->input('petfriendly') == 1){ $petfriendly=1; }
		

						
		
		
		$data=[
    		'name' => $request->input('title'),
			'description' => $request->input('description'),
			'location' => $request->input('location'),
			'address' => $request->input('address'),
			'streetname' => $geodata['streetName'] ? $geodata['streetName'] : '',
			'streetnumber' => $geodata['streetNumber'] ? $geodata['streetNumber'] : '',
			'lat' => $geodata['latitude'] ? $geodata['latitude'] : 0,
			'long' => $geodata['longitude'] ? $geodata['longitude'] : 0,
			'locality' => $geodata['locality'] ? $geodata['locality'] : '',
			'sublocality' => $geodata['subLocality'] ? $geodata['subLocality'] : '',
			'postalcode' => $geodata['postalCode'] ? $geodata['postalCode'] : '', 
			'parking' => $parking,
			'storage' => $storage,
			'petfriendly' => $petfriendly,
			'furnished' => $furnished,
			
			
			'listingtype' => $request->input('listingtype'),
			'bedrooms' => $request->input('bedrooms') ? $request->input('bedrooms') : '',
			'bathrooms' => $request->input('bathrooms')  ? $request->input('bathrooms') : '',
			'size' => $request->input('size') ? $request->input('size') : 0,
			'price' => $request->input('price') ? $request->input('price') : 0,
			'forsaleby' => $request->input('forsaleby') ? $request->input('forsaleby') : 1,
			'type' => $request->input('type'),
			'phone' => $request->input('phone') ? $request->input('phone') : '',
			'youtube' => $request->input('youtube') ? $request->input('youtube') : '',
			'website' => $request->input('website')? $request->input('website') : '',
			'photo1' => $photo1,
			'photo2' => $photo2,
			'photo3' => $photo3,
			'photo4' => $photo4,
			'photo5' => $photo5,
			'photo6' => $photo6,
			'photo7' => $photo7,
			'photo8' => $photo8,
			'photo9' => $photo9,
			'paytype' => 0,
			'phone' => $request->input('phone')? $request->input('phone') : '',
			'who' => Auth::user()->id
		];
		
		
			
		
		
		
		$data2=Alerts::checkAlerts();
		
		
		
		if(!empty($request->input('id')) && $request->input('id') > 0 ){
		
			$listing = Listings::where('ID', $request->input('id'))->update($data);
			return redirect()->route('myproperties')->with('status', 'Listing Changes have been saved.');
			
		}
		else 
		{
			$listing = Listings::create($data);
			$returnarray['listing_id']=$listing->id;
		
		
        	return view('created', $returnarray);
		}
		
		
		
    }
}
