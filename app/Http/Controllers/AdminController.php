<?php

namespace App\Http\Controllers;

use App\Users;
use App\Listings;
use App;
use App\Admin;
use Input;
use Auth;
use App\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestF;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
				
    }
	
	public function index()
	{

		if(Auth::user()->role != 1) 
		return redirect('/');


		$returnarray=array();
		$returnarray['Title']="Home";
		
		return view('admin', $returnarray);
	}
	
	public function users()
	{
		
		$admin=new Admin();
                $users=$admin->getUsers();
                $data['Users']=$users;
                $data['Title']='Users';
                return view('admin/users', $data);
	}
	
	public function unapproveListing()
	{
		$admin=new Admin();
        $users=$admin->approveListing($id, 0);
		return redirect('admin/listings/approved')->with('status', 'The listing was approved');
	}
	
	public function moveItem(Request $request, $type, $action, $id)
	{
		
		$admin=new Admin();
		$admin->moveItem($type, $action, $id);
	
		
	}
	
	public function approveListing($id)
	{
		
		$admin=new Admin();
        $users=$admin->approveListing($id, 1);
		return redirect('admin/listings/approved')->with('status', 'The listing was approved');
	}
	
	public function listings()
	{
		
		$admin=new Admin();
		$listings=$admin->getListings();
		$data['Listings']=$listings;
		$data['Title']='Listings';
		$data['approved']=0;
		return view('admin/listings', $data);
	}
	
	public function listingsUnApproved()
	{
		
		$admin=new Admin();
		$data['approved']=01;
		$listings=$admin->getListings(1);
		$data['Listings']=$listings;
		$data['Title']='Listings';
		return view('admin/listings', $data);
	}
	
	public function categorylistings()
	{
		
		$admin=new Admin();
		$categorylistings=$admin->getCategoryListings();
		$data['CategoryListings']=$categorylistings;
		$data['Title']='Listing Categories';
		$data['mtype']="Categories";
		return view('admin/listingcategories', $data);
	}
	
	public function regions()
	{
		
		$admin=new Admin();
		$categorylistings=$admin->getRegions();
		$data['Regions']=$categorylistings;
		$data['Title']='Regions';
		$data['mtype']="Regions";
		return view('admin/regions', $data);
	}

	public function addUser()
    {
      	$admin=new Admin();

		$data['id']=0;
		$data['Title']="Add User";
		return view('admin/user', $data);
	}


	public function editUser($id)
	{
			$admin=new Admin();
			$data['id']=$id;
	

			$User=$admin->getUser($id);
			

	Input::merge(array('name' => $User->name));
	Input::merge(array('email' => $User->email));
	Input::merge(array('first_name' => $User->first_name));
	Input::merge(array('last_name' => $User->last_name));

	Input::merge(array('updated_at' => $User->updated_at));
	Input::merge(array('created_at' => $User->created_at));
			Input::merge(array('role' => $User->role));
			$data['Title']="Edit User";
			
		

			return view('admin/user', $data);
	}

	public function deleteUser($id)
	{
			$admin=new Admin();
			$admin->deleteUser($id);
			return redirect('admin/users')->with('status', 'The user was deleted');
	}
	
	public function deleteRegion($id)
	{
			$admin=new Admin();
			$admin->deleteRegion($id);
			return redirect('admin/regions')->with('status', 'The region was deleted');
	}

	public function deleteListing($id)
	{
			$admin=new Admin();
			$admin->deleteListing($id);
			return redirect('admin/listings')->with('status', 'The listing was deleted');
	}
	
	public function deleteCategory($id)
	{
			$admin=new Admin();
			$admin->deleteCategory($id);
			return redirect('admin/categories')->with('status', 'The listing category was deleted');
	}
	
	
	public function listingSave(Request $request, $id = null)
        {
			
			
		$validatedData = $request->validate([
        	'title' => 'required|max:255',
        	'description' => 'required|max:10000', 
			'address' => 'required|max:255',
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
			'listingtype' => $request->input('listingtype'),
			'bedrooms' => $request->input('bedrooms'),
			'bathrooms' => $request->input('bathrooms'),
			'size' => $request->input('size'),
			'price' => $request->input('price'),
			'forsaleby' => $request->input('forsaleby'),
			'type' => $request->input('type'),
			'youtube' => $request->input('youtube') ? $request->input('youtube') : '',
			'website' => $request->input('website')? $request->input('website') : '',
			'sticky' => $request->input('featured')? $request->input('featured') : 0,
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
		
		 
		
		if(!empty($request->input('id')) && $request->input('id') > 0 ){
			//$data['Title']="Add Listing";
			$listing = Listings::where('ID', $request->input('id'))->update($data);

			
		}
		else 
		{
			// $data['Title']="Edit Listing";
			$listing = Listings::create($data);
			$returnarray['listing_id']=$listing->id;
			
		}
		
		  return Redirect::to('admin/listings')->with('status', 'Listing Saved');
		
                $data['Title']="Add Listing";
                $redirect_loc='add';
                if($id)
                {
                        $redirect_loc='edit/'.$id;
                        $data['Title']="Edit Listing";
                }

                $rules = array(
                        'name'          => 'required|max:255',		
                );

                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails())
                {
                        $messages = $validator->messages();
                        return Redirect::to('admin/user/' . $redirect_loc)
                        ->withErrors($validator)
                        ->withInput(Input::all());
                }
                else
                {
			
                        $admin=new Admin();

                        $Listing['name']=Input::get('name');
						//$Listing['role']=Input::get('role');
					//	$Listing['updated_at']=strtotime("now"); 
		

						

                        if($id)
                        {
                                $admin->editListing($id, $Listing);
                        }
                        else
                        {
								$Listing['created_at']=strtotime("now");
                                $admin->addListing($Listing);
                        }
										
                        return Redirect::to('admin/listings')->with('status', 'Listing ' . $Listing['name'] . ' Saved');

                }
        }

	public function userSave($id = null)
        {
                $data['Title']="Add User";
                $redirect_loc='add';
                if($id)
                {
                        $redirect_loc='edit/'.$id;
                        $data['Title']="Edit User";
                }

                $rules = array(
                        'name'          => 'required|max:255',
						'email' 		=> 'required',	
						'password' => 'confirmed',		
                );

                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails())
                {
                        $messages = $validator->messages();
                        return Redirect::to('admin/user/' . $redirect_loc)
                        ->withErrors($validator)
                        ->withInput(Input::all());
                }
                else
                {
			
                        $admin=new Admin();

                        $User['name']=Input::get('name');
						$User['role']=Input::get('role');
						$User['email']=Input::get('email');
						$User['first_name']=Input::get('first_name');
						$User['last_name']=Input::get('last_name');
					//	$User['updated_at']=strtotime("now"); 
					
				
		

						if(Input::get('password') != '')
						{
							$User['password']=bcrypt(Input::get('password'));
						}
						
	

                        if($id)
                        {
                                $admin->editUser($id, $User);
                        }
                        else
                        {
								$User['created_at']=strtotime("now");
                                $admin->addUser($User);
                        }
										
                        return Redirect::to('admin/users')->with('status', 'User ' . $User['name'] . ' Saved');

                }
        }
		
		
		public function regionSave($id = null)
        {
		
                $data['Title']="Add Region";
                $redirect_loc='add';
                if($id)
                {
                        $redirect_loc='edit/'.$id;
                        $data['Title']="Edit Region";
                }

                $rules = array(
                        'name'          => 'required|max:255',	
				
                );

                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails())
                {
                        $messages = $validator->messages();
                        return Redirect::to('admin/region/' . $redirect_loc)
                        ->withErrors($validator)
                        ->withInput(Input::all());
                }
                else
                {
			
                        $admin=new Admin();

                        $Region['name']=Input::get('name');
			
					//	$Region['updated_at']=strtotime("now"); 

                        if($id)
                        {
                                $admin->editRegion($id, $Region);
                        }
                        else
                        {
								$Region['created_at']=strtotime("now");
                                $admin->addRegion($Region);
                        }
										
                        return Redirect::to('admin/regions')->with('status', 'Region ' . $Region['name'] . ' Saved');

                }
        }
		
		
		public function categorySave($id = null)
        {
                $data['Title']="Add Category";
                $redirect_loc='add';
                if($id)
                {
                        $redirect_loc='edit/'.$id;
                        $data['Title']="Edit Category";
                }

                $rules = array(
                        'name'          => 'required|max:255',			
                );

                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails())
                {
                        $messages = $validator->messages();
                        return Redirect::to('admin/category/' . $redirect_loc)
                        ->withErrors($validator)
                        ->withInput(Input::all());
                }
                else
                {
			
                        $admin=new Admin();

                        $Category['name']=Input::get('name');
						

                        if($id)
                        {
                                $admin->editListingCategory($id, $Category);
                        }
                        else
                        {
								
                                $admin->addListingCategory($Category);
                        }
										
                        return Redirect::to('admin/categories')->with('status', 'Category ' . $Category['name'] . ' Saved');

                }
        }

	
	/*
	public function users()
	{
		$returnarray=array();
		return view('adminusers', $returnarray);
	}
	
	public function user(User $user)
	{
		$returnarray=array();
		return view('adminlisting', $returnarray);
	}
	*/
	
	
	
	public function listingcategory(Request $request)
	{
		$returnarray=array();
		return view('adminlisting', $returnarray);
	}
	
	
	
	
	
	
	public function listing(Request $request)
	{
		$returnarray=array();
		return view('adminlisting', $returnarray);
	}
	
	public function editListing($id)
	{
		$admin=new Admin();
		$data['id']=$id;
		
		$listing=Listings::where('who', Auth::user()->id)->where('id', $id)->first();

	
		
		$data['listing']=$listing;
		
		$locations=Locations::get();
		$listingtypes=Listings::getTypes();
		$data['listingtypes']=$listingtypes;
		
		$data['locations']=$locations;


		$Listing=$admin->getListing($id);

		Input::merge(array('name' => $Listing->name));
		Input::merge(array('description' => $Listing->description));
		Input::merge(array('type' => $Listing->type));
		Input::merge(array('address' => $Listing->address));
		Input::merge(array('lat' => $Listing->lat));
		Input::merge(array('long' => $Listing->long));
		Input::merge(array('streetname' => $Listing->streetname));
		Input::merge(array('streetnumber' => $Listing->streetnumber));
		Input::merge(array('locality' => $Listing->locality));
		Input::merge(array('sublocality' => $Listing->sublocality));
		Input::merge(array('postalcode' => $Listing->postalcode));
		Input::merge(array('location' => $Listing->location));
		Input::merge(array('youtube' => $Listing->youtube));
		Input::merge(array('website' => $Listing->website));
		Input::merge(array('phone' => $Listing->phone));
		Input::merge(array('email' => $Listing->email));
		Input::merge(array('paytype' => $Listing->paytype));
		Input::merge(array('who' => $Listing->who));
		
		Input::merge(array('status' => $Listing->status));
		
	
		Input::merge(array('updated_at' => $Listing->updated_at));
		Input::merge(array('created_at' => $Listing->created_at));
		$data['Title']="Edit Listing";

		return view('admin/listing', $data);
	}
	
	public function editCategoryListing($id)
	{
		$admin=new Admin();
		$data['id']=$id;


		$CategoryListing=$admin->getCategoryListing($id);
	

		Input::merge(array('name' => $CategoryListing->name));
		
		$data['Title']="Edit Listing Category";
	

		return view('admin/listingcategory', $data);
	}
	
	public function editRegion($id)
	{
		$admin=new Admin();
		$data['id']=$id;


		$Region=$admin->getRegion($id);
	

		Input::merge(array('name' => $Region->name));
		
		$data['Title']="Edit Region";
	

		return view('admin/listingcategory', $data);
	}
	
	
	/*
	public function usersave(Request $request)
	{
		
		$validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
      ]);
 

    
        User::where('id', Auth::user()->id)->update([
            'name' => $request->input('name'),
            'email' => $data['email'],
        ]);
	
		
		
		return redirect()->route('adminuser')->with('status', 'Profile updated!');
    }
	*/
	

	
	public function listingcategorysave(Request $request)
	{
		
		$validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
      ]);
 

    
        User::where('id', Auth::user()->id)->update([
            'name' => $request->input('name'),
            'email' => $data['email'],
        ]);
	
		
		
		return redirect()->route('adminuser')->with('status', 'Profile updated!');
    }
	
	
	public function addListing()
    {
      	$admin=new Admin();
		
		$locations=Locations::get();
		$listingtypes=Listings::getTypes();
		$returnarray['listingtypes']=$listingtypes;
		
		$returnarray['locations']=$locations;

		$returnarray['id']=0;
		$returnarray['Title']="Add Listing";
		return view('admin/listing', $returnarray);
	}
	
	
	public function addRegion()
    {
	
      	$admin=new Admin();

		$data['id']=0;
		$data['Title']="Add Region";
		return view('admin/region', $data);
	}
	
	
	public function addCategory()
    {
      	$admin=new Admin();

		$data['id']=0;
		$data['Title']="Add Category";
		return view('admin/listingcategory', $data);
	}
}
