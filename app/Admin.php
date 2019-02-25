<?php

namespace App;

use App\Locations;
use App\Listings;
use App\Categories;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	public function moveItem($type, $action, $id)
	{
		$model='';
		if($type == "Regions")
		{
			$model=new Locations();
		}
		elseif($type == "Categories") {
			$model=new Categories();
		}
		else {
			return false;
		}
		
		$data=$model->orderBy('ordering')->get();
		$cnt=1;
		foreach($data as $d)
		{
			$model->where('id', $d->id)->update(['ordering' => $cnt]);
			$cnt++;
		}

	
		$previd=0;
		$prevordering=0;
		$savenext=false;
		foreach($data as $d)
		{
			if($d->id == $id && $action == "up")
			{
				$model->where('id', $id)->update(['ordering' => $prevordering]);
				$model->where('id', $previd)->update(['ordering' => $d->ordering]);
			}
			
			
			if($savenext == true)
			{
			
				
				$model->where('id', $id)->update(['ordering' => $d->ordering]);
				$model->where('id', $d->id)->update(['ordering' => $prevordering]);
				$savenext=false;
				
			}
			if($d->id == $id && $action == "down")
			{
				$savenext=true;
			}
			$previd=$d->id;
			$prevordering=$d->ordering;
			
		}
	}
         public function editUser($UserID, $User)
        {
                \DB::table('users')->where('id', '=', $UserID)->update($User);
        }
		
		
        public function getUser($UserID)
        {
                $user=\DB::table('users')
                        ->where('id', '=', $UserID)
                        ->first();

                return $user;
        }

        public function deleteUser($UserID)
        {
                \DB::table('users')
                ->where('id', '=', $UserID)
                ->delete();
        }


	public function approveListing($id, $type)
	{
	
		 $user=\DB::table('listings')
				 		->where('id', $id)
                        ->update(['approved' => $type]);
	}
	public function addUser($User)
        {

		\DB::table('users')
                ->insert($User);

        }
	public function getUsers()
        {

                $users=\DB::table('users')->get();
                return $users;
        }
	

		
		public function getListings($id=0)
        {
			if($id > 0)
			{
				 $user=\DB::table('listings')
				 		->where('approved', 0)
                        ->get();
			}
			else {
				
                $user=\DB::table('listings')
                        ->get();
			}

                return $user;
        }
		
		
        public function getListing($UserID)
        {
                $data=\DB::table('listings')
                        ->where('id', '=', $UserID)
                        ->first();

                return $data;
        }

        public function deleteListing($id)
        {
                \DB::table('listings')
                ->where('id', '=', $id)
                ->delete();
        }
		
		 public function deleteRegion($id)
        {
			
			\DB::table('locationlistings')
                ->where('id', '=', $id)
                ->delete();
		      
        }
		
		 public function deleteCategory($id)
        {
                \DB::table('categorylistings')
                ->where('id', '=', $id)
                ->delete();
        }
		
		public function addRegion($Record)
        {
            	
			$new_record=Locations::create($Record);
			$new_record->ordering=$new_record->id;
			$new_record->save();
				
        }

		public function addListing($Record)
        {
            	
			\DB::table('listings')
                ->insert($Record);
				
        }
		
		public function addListingCategory($Record)
        {
            	
			\DB::table('categorylistings')
                ->insert($Record);
				
			$new_record=Categories::create($Record);
			$new_record->ordering=$new_record->id;
			$new_record->save();
				
        }

	public function getCategoryListings()
	{

			$users=\DB::table('categorylistings')->get();
			return $users;

	}
	
	public function getCategoryListing($id)
	{

			$data=\DB::table('categorylistings')
                        ->where('id', '=', $id)
                        ->first();

                return $data;

	}
	
	public function getRegion($id)
	{

			$data=\DB::table('locationlistings')
                        ->where('id', '=', $id)
                        ->first();

                return $data;

	}
		
	public function getRegions()
	{

			$users=\DB::table('locationlistings')->orderBy('ordering')->get();
			return $users;

	}
	
	public function editListing($ID, $Record)
    {
    	\DB::table('listings')->where('id', '=', $ID)->update($Record);
	}
	
	public function editListingCategory($ID, $Record)
    {
    	\DB::table('categorylistings')->where('id', '=', $ID)->update($Record);
	}
	
	public function editRegion($ID, $Record)
    {
    	\DB::table('listings')->where('id', '=', $ID)->update($Record);
	}
        
		
		
}
