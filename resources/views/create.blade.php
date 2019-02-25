@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function(){
	var cnt=1;
	<?php if(!isset($id)){ ?>
    $("#photo2_group").hide();
	$("#photo3_group").hide();
	$("#photo4_group").hide();
	$("#photo5_group").hide();
	$("#photo6_group").hide();
	$("#photo7_group").hide();
	$("#photo8_group").hide();
	$("#photo9_group").hide();
	
    $("#anotherphoto").on("click", function(){
		cnt++;
        $("#photo" + cnt + "_group").show();
    });
	
<?php } ?>
	
	$("#form-group-furnished").hide();
	$("#form-group-petfriendly").hide();
	$("#listingtype").on("change", function(){
	

	$("#form-group-furnished").hide();
	$("#form-group-petfriendly").hide();
	$("#form-group-forrentby").hide();
	$("#form-group-storage").hide();
	$("#form-group-parking").hide();
	
	if(!$("#form-group-forsaleby").is(":visible")) $("#form-group-forsaleby").show(); 
	
	if(!$("#form-group-rooms").is(":visible")) $("#form-group-rooms").show(); 
	
	if(!$("#form-group-size").is(":visible")) $("#form-group-size").show(); 
	
	
	$("#form-group-size").show(); 
	
			console.log(this.value);
		if(this.value == 1)
		{
			// All in Real Estate - (include: furnished, pet friendly) (disclude: size, bedrooms, washrooms, For Sale By)
			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			
			$("#form-group-size").hide();
			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").hide();
			
		}
		else if(this.value == 2)
		{
			
				console.log('in 2');
			$("#form-group-forsaleby").hide();
			$("#form-group-size").hide();
			
			
			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			$("#form-group-forrentby").show();
			
		}
		else if(this.value == 3)
		{
				console.log('in 3');
			// Room Rentals & Roommates (Include: furnished, pet friendly) (disclude: size, bedrooms, washrooms, for sale by)
			
			$("#form-group-size").hide();
			$("#form-group-forsaleby").hide();
			
		
			
			

			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			$("#form-group-forrentby").show();
			
		}
		else if(this.value == 4)
		{
				console.log('in 4');
			// Short Term Rentals - (Include: furnished, pet friendly, For Rent By:) (disclude: size, for sale by)

			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			
			$("#form-group-size").hide();
			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").hide();
		}
		else if(this.value == 5)
		{
				console.log('in 5');
			// Commercial & Office Space for Rent - (Include: furnished, For Rent By:) (disclude: for sale by, bedrooms, bathrooms)

			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			$("#form-group-forrentby").show();
			
			$("#form-group-size").hide();
			$("#form-group-forsaleby").hide();
		}
		else if(this.value == 6)
		{
				console.log('in 6');
			// Storage & Parking for Rent - (Add Filter: More Info: Parking | Storage) (disclude: size, for sale by, bedrooms, bathrooms)

			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").hide();
			$("#form-group-furnished").show();
		
			$("#form-group-forrentby").show();
		}
		else if(this.value == 7)
		{
			
			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").hide();
			$("#form-group-size").hide();
		
			$("#form-group-forrentby").show();
			
			$("#form-group-parking").show();
				$("#form-group-petfriendly").hide();
			
			
		}
		else if(this.value == 8)
		{
			
			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").show();
			$("#form-group-size").hide();
			$("#form-group-parking").show();
			$("#form-group-petfriendly").hide();
		
			
			
		}
		else if(this.value == 9)
		{
			
			
	
			
		}
		else if(this.value == 10)
		{
			
			
	
			
		}
		else if(this.value == 11)
		{
			
			// Land for Sale - (disclude: size, bedrooms, bathrooms)
			$("#form-group-rooms").hide();
			$("#form-group-forsaleby").hide();
			$("#form-group-size").hide();
			
		}
		else 
		{
			console.log('other');
			$("#form-group-rooms").hide();
			$("#form-group-forrentby").show();
			$("#form-group-size").hide();
		}
		
    });
	
	<?php if(isset($listing->listingtype) && $listing->listingtype > 2){ ?>
	$("#listingtype").val(0);
	
	$("#listingtype").val("<?php echo $listing->listingtype; ?>");
	<?php } else {
	?>
	
		$("#form-group-furnished").hide();
	$("#form-group-petfriendly").hide();
	$("#form-group-forrentby").hide();
	$("#form-group-storage").hide();
	$("#form-group-parking").hide();
	
	$("#form-group-forsaleby").hide();
			$("#form-group-size").hide();
			
			
			$("#form-group-furnished").show();
			$("#form-group-petfriendly").show();
			$("#form-group-forrentby").show();

	<?php	
	}?>
	
	

});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">@if(isset($id)) Edit @else Create @endif</div>

                <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        
                         
                   
                    <form method="post" action="{{ route('create') }}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : 0}}" />
   {{ csrf_field() }}
  <div class="form-group">
  <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" value="1" name="type" class="custom-control-input" <?php if(isset($listing->type) && $listing->type == 1 || !isset($listing->type)){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio1">I am offering</label>
</div>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" value="2" name="type" class="custom-control-input" <?php if(isset($listing->type) && $listing->type == 2){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio2">I am looking for</label>
  </div>
   <label for="type">Categories:</label>
    <select class="form-control" id="listingtype" name="listingtype">
  	@foreach($listingtypes as $type)
      @if($type->id > 1)
      <option value="{{$type->id}}">{{$type->name}}</option>
      @endif
    @endforeach
    </select> 
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Title of my Ad!" value="{{isset($listing->name) ? $listing->name : isset($listing->name) ? : old('title')}}">
  </div>
  <div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="6" cols="40">{{isset($listing->description) ? $listing->description : old('title')}}</textarea>
   
  </div>
  
  <div class="form-group">
   <label for="location">Location</label>
  <select class="form-control" id="location" name="location">
  	@foreach($locations as $location)
      <option value="{{$location->id}}"<?php if(isset($listing->location) && $listing->location == $location->id){ ?> SELECTED <?php } ?>>{{$location->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" id="address" placeholder="Address or Postal Code!" value="{{isset($listing->address) ? $listing->address : ''}}">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone" placeholder="416-999-9999" value="{{isset($listing->phone) ? $listing->phone : ''}}">
  </div>
  
  <div class="form-group" id="form-group-price">
    <label for="price">Price</label><br />
    <input type="text" name="price" size="10"  id="price" placeholder="" value="{{isset($listing->price) ? $listing->price : ''}}">
  </div>
  <div class="form-group" id="form-group-size">
    <label for="size">Size</label><br />
    <input type="text" size="3" name="size" id="size" placeholder="" value="{{isset($listing->size) ? $listing->size : ''}}">
  </div>
  
<div id="form-group-furnished">
<h4>Furnished</h4>
  <div class="form-check">
    <input class="form-check-input" name="furnished" type="radio" id="furnished" value="1"<?php if(isset($listing->furnished) && $listing->furnished==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="furnished">Yes</label> <br /> 
</div>
  <div class="form-check" id="form-group-furnished">
    <input class="form-check-input" name="furnished" type="radio" id="furnished-2" value="2"<?php if(isset($listing->furnished) && $listing->furnished!=1){ echo ' checked'; }?>>
    <label class="form-check-label" for="furnished-2">No</label> <br />
</div> <br /><br />
</div>

<div id="form-group-petfriendly">
<h4>Pet Friendly</h4>
 <div class="form-check">
    <input class="form-check-input" name="petfriendly" type="radio" id="petfriendly" value="1"<?php if(isset($listing->petfriendly) && $listing->petfriendly==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="petfriendly"> Yes</label>
    <br />

</div>
 <div class="form-check">
    <input class="form-check-input" name="petfriendly" type="radio" id="petfriendly-1" value="2"<?php if(isset($listing->petfriendly) && $listing->petfriendly!=1){ echo ' checked'; }?>>
    <label class="form-check-label" for="petfriendly-1"> No</label> <br /> 

</div>
<br /><br />
</div>

  <div id="form-group-parking">
  <h4>Parking and Storage</h4>
  <div class="form-check">
  

    <input class="form-check-input" name="parking" type="radio" id="parking" value="1"<?php if(isset($listing->parking) && $listing->parking==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="parking">Parking</label> <br /> 
</div>


<div class="form-check">
    <input class="form-check-input" name="parking" type="radio" id="parking-2" value="2"<?php if(isset($listing->storage) && $listing->storage==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="storage">Storage</label> <br /> 

</div>
</div>

    
  <div class="form-group" id="form-group-rooms">
  <table width="100%">
  <tr><td width="50%" valign="top">
  
  
  <label for="bedrooms"># Bedrooms</label>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom1" value="1"<?php if(isset($listing->bedrooms) && $listing->bedrooms==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom1">Bachelor or studio</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom1" value="2"<?php if(isset($listing->bedrooms) && $listing->bedrooms==2){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom2">1 bedroom</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom3" value="3"<?php if(isset($listing->bedrooms) && $listing->bedrooms==3){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom3">1 bedroom and den</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom4" value="4"<?php if(isset($listing->bedrooms) && $listing->bedrooms==4){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom4">2 bedrooms</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom5" value="5"<?php if(isset($listing->bedrooms) && $listing->bedrooms==5){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom5">2 bedrooms and den</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom6" value="6"<?php if(isset($listing->bedrooms) && $listing->bedrooms==6){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom6">3 bedrooms</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom7" value="7"<?php if(isset($listing->bedrooms) && $listing->bedrooms==7){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom7">4 bedrooms</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom8" value="8"<?php if(isset($listing->bedrooms) && $listing->bedrooms==8){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom8">5 bedrooms</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bedrooms" type="radio" id="bedroom9" value="9"<?php if(isset($listing->bedrooms) && $listing->bedrooms==9){ echo ' checked'; }?>>
    <label class="form-check-label" for="bedroom9">6 or more bedrooms</label>
</div>

  

</td><td width="50%" valign="top">


  <label for="bathrooms"># Bathrooms</label>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom1" value="1"<?php if(isset($listing->bathrooms) && $listing->bathrooms==1){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom1">1</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom1" value="2"<?php if(isset($listing->bathrooms) && $listing->bathrooms==2){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom2">1.5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom3" value="3"<?php if(isset($listing->bathrooms) && $listing->bathrooms==3){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom3">2</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom4" value="4"<?php if(isset($listing->bathrooms) && $listing->bathrooms==4){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom4">2.5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom5" value="5"<?php if(isset($listing->bathrooms) && $listing->bathrooms==5){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom5">3</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom6" value="6"<?php if(isset($listing->bathrooms) && $listing->bathrooms==6){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom6">3.5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom7" value="7"<?php if(isset($listing->bathrooms) && $listing->bathrooms==7){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom7">4</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom8" value="8"<?php if(isset($listing->bathrooms) && $listing->bathrooms==8){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom8">4.5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom9" value="9"<?php if(isset($listing->bathrooms) && $listing->bathrooms==9){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom9">5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom10" value="10"<?php if(isset($listing->bathrooms) && $listing->bathrooms==10){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom10">5.5</label>
</div>
<div class="form-check">
    <input class="form-check-input" name="bathrooms" type="radio" id="bathroom11" value="11"<?php if(isset($listing->bathrooms) && $listing->bathrooms==11){ echo ' checked'; }?>>
    <label class="form-check-label" for="bathroom11">6 or more</label>
</div>
</td></tr></table>

</div>
<br />
<div id="form-group-forsaleby">
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio3" value="1" name="forsaleby" class="custom-control-input" <?php if(isset($listing->forsaleby) && $listing->forsaleby == 1 || !isset($listing->forsaleby)){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio3">For Sale by: Owner</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio4" value="2" name="forsaleby" class="custom-control-input" <?php if(isset($listing->forsaleby) && $listing->forsaleby == 2){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio4">For Sale by: Professional</label>

  </div>
  </div>
 
  <br /><br />
  <div id="form-group-forrentby">
 <div class="custom-control custom-radio"> 
  <input type="radio" id="customRadio5" value="3" name="forsaleby" class="custom-control-input" <?php if(isset($listing->forsaleby) && $listing->forsaleby == 3 || !isset($listing->forsaleby)){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio5">For Rent by: Owner</label>

</div>

<div class="custom-control custom-radio">
  <input type="radio" id="customRadio6" value="4" name="forsaleby" class="custom-control-input" <?php if(isset($listing->forsaleby) && $listing->forsaleby == 4){ ?> CHECKED <?php } ?>>
  <label class="custom-control-label" for="customRadio6">For Rent by: Professional</label>
 <br /><br />
  </div>
  </div>

  
  <div class="form-group">
    <label for="youtube">Youtube Video</label>
    <input type="text" name="youtube" class="form-control" id="youtube" placeholder="Have a youtube video?  Enter it here!" value="{{isset($listing->youtube) ? $listing->youtube : ''}}">
  </div>
  
  <div class="form-group">
    <label for="website">Website</label>
    <input type="text" name="website" class="form-control" id="website" placeholder="Have website?  Enter it here!" value="{{isset($listing->website) ? $listing->website : ''}}">
  </div>
  
   <div class="form-group">
     
  <div id="photo1_group">
  <?php if(isset($listing->photo1) && $listing->photo1 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo1) }}" /><br /><?php } ?> 
  <input type="file" id="photo1" name="photo1">
  <label for="photo1">Choose a picture - * Primary (This photo will appear as the primary photo in your listing)</label>
  </div>
  <div id="photo2_group">
  <?php if(isset($listing->photo2) && $listing->photo2 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo2) }}" /><br /><?php } ?>
  <input type="file" id="photo2" name="photo2">
  <label for="photo2">Choose a picture</label>
  </div>
  <div id="photo3_group">
  <?php if(isset($listing->photo3) && $listing->photo3 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo3) }}" /><br /><?php } ?>
  <input type="file" id="photo3" name="photo3">
  <label for="photo3">Choose a picture</label>
  </div>
  <div id="photo4_group">
  <?php if(isset($listing->photo4) && $listing->photo4 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo4) }}" /><br /><?php } ?>
  <input type="file" id="photo4" name="photo4">
  <label for="photo4">Choose a picture</label>
  </div>
  <div id="photo5_group">
  <?php if(isset($listing->photo5) && $listing->photo5 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo5) }}" /><br /><?php } ?>
  <input type="file" id="photo5" name="photo5">
  <label for="photo5">Choose a picture</label>
  </div>
  <div id="photo6_group">
  <?php if(isset($listing->photo6) && $listing->photo6 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo6) }}" /><br /><?php } ?>
  <input type="file" id="photo6" name="photo6">
  <label for="photo6">Choose a picture</label>
  </div>
  <div id="photo7_group">
  <?php if(isset($listing->photo7) && $listing->photo7 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo7) }}" /><br /><?php } ?>
  <input type="file" id="photo7" name="photo7">
  
  <label for="photo7">Choose a picture</label>
  </div>
  <div id="photo8_group">
  <?php if(isset($listing->photo8) && $listing->photo8 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo8) }}" /><br /><?php } ?>
  <input type="file" id="photo8" name="photo8">
  
  <label for="photo8">Choose a picture</label>
  </div>
  <div id="photo9_group">
  <?php if(isset($listing->photo9) && $listing->photo9 != ''){ ?><img style="height: 25px;" src="{{ asset('images/listings/' . $listing->photo9) }}" /><br /><?php } ?>
  <input type="file" id="photo9" name="photo9">
  <label for="photo9">Choose a picture</label>
  </div> <?php if(!isset($id)){ ?>
  <input type="button" id="anotherphoto" class="btn btn-primary" value="Add Another Photo"><?php } ?>
  </div>



	
</div>
  

  <div class="form-group">
  <input class="form-control btn-primary" type="submit" name="post" value="Post" />
   
  </div>
</form>

                    
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
