@extends('layouts.app')

@section('content')
<style>
#top-menu .current a
{
    color: orange !important;
}

#rangeid .slider-selection {
	background: #BABABA;
}

#ex1Slider .slider-selection {
	background: #BABABA;
}

.slidecontainer {
    width: 100%; /* Width of the outside container */
}

/* The slider itself */
.slider {
    -webkit-appearance: none;  /* Override default CSS styles */
    appearance: none;
    width: 100%; /* Full-width */
    height: 25px; /* Specified height */
    background: #d3d3d3; /* Grey background */
    outline: none; /* Remove outline */
    opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
    -webkit-transition: .2s; /* 0.2 seconds transition on hover */
    transition: opacity .2s;
}

/* Mouse-over effects */
.slider:hover {
    opacity: 1; /* Fully shown on mouse-over */
}

/* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
.slider::-webkit-slider-thumb {
    -webkit-appearance: none; /* Override default look */
    appearance: none;
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}

.slider::-moz-range-thumb {
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}
.input-group-xs>.form-control,
.input-group-xs>.input-group-addon,
.input-group-xs>.input-group-btn>.btn {
    height: 22px;
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
}
</style>


<div class="container-fluid">


    <div class="row justify-content-center">
    <div class="col-md-2">
        <div class="container-fluid">
    <div class="panel panel-default">
    <div class="panel-body">
    <h3>Current Matches ({{$Listings->total()}})</h3>
    <hr />
    <h4>Address</h4>
    <div class="form-inline">
    <input type="button" style="display: none; visibility: hidden;" id="addressupdate" value="update" />
    <input type="text" name="address" id="address" value="{{ $Address }}" /></div>
    <div class="slidecontainer">
    <label for="idradiusm">Distance From: </label>
  <input type="range"  id="radiusm" min="1" max="1000" step="1" value="<?php if(request()->query('radius') !== null && request()->query('radius') > 49){ echo request()->query('radius'); } else { echo '1'; } ?>">
  
</div>
    Radius: <input type="text" size="4" id="radius" value="{{request()->query('radius')}}" />
    <br /><br />
    <h4>Categories</h4>
    <a id="selectMoreCategories" style="font-size: 200%"class="text-big" href="#">+ </a>
    @foreach($types as $type)   
       
       @if($type->id == request()->query('listingtype'))
       	<b>{{$type->name}}</b><br />
     
       @endif
    
       		
    @endforeach
    
    <div id="divHiddenFilterCategories" style="display: none;">
    @if(request()->query('listingtype') < 2)
      
       @else
       
       @endif
    
  	@foreach($types as $type)   
       
       @if($type->id == request()->query('listingtype'))
       	 <!-- <b>{{$type->name}}</b><br />-->
       @else
      <a class="redirectme" href="{{Request::fullUrl()}}&listingtype={{$type->id}}">{{$type->name}}</a><br>
       @endif
    
       		
    @endforeach

   
    </div> <br /> <br />
    <!--<input id="range" data-slider-id='rangeid' type="text" data-slider-min="50" data-slider-max="1000" data-slider-step="50" data-slider-value="50"/>-->
     
    <h4>Location</h4>
    <a id="selectMoreLocations" style="font-size: 200%" class="text-big" href="#">+ 
    </a> @foreach($locations as $location) 
       @if($location->id == request()->query('location'))
       	<b>{{$location->name}}</b><br />
      @endif   		
    @endforeach
    <div id="divHiddenFilterLocations" style="display: none;">
    
    @if(request()->query('location') < 0)
       	
       @else
       	<a class="current" href="{{Request::fullUrl('')}}&location=0">All</a><br />
       @endif
    
  	@foreach($locations as $location) 
       @if($location->id == request()->query('location'))
       <!--	<b>{{$location->name}}</b><br />-->
       @else
        <a class="redirectme" href="{{Request::fullUrl()}}&location={{$location->id}}">{{$location->name}}</a><br>
       @endif
       
       		
    @endforeach
 </div><br />
    <br />
    <h4>Offer Type</h4>
    @if(request()->query('offertype') < 1)
       	<b>All</b><br />
       @else
       	<a class="redirectme" href="{{Request::fullUrl()}}&offertype=0">All</a><br>
       @endif
     
     @if(request()->query('offertype') == 1)
       	<b>Offering</b><br />
       @else
     <a class="redirectme" href="{{Request::fullUrl()}}&offertype=1">Offering</a><br>
     @endif
     @if(request()->query('offertype') == 2)
       	<b>Wanted</b><br />
       @else
     <a class="redirectme" href="{{Request::fullUrl()}}&offertype=2">Wanted</a><br>
     @endif
     <br>
    <h4>Price</h4>
    	from <input type="text" id="pricestart" name="pricestart" size="3" class="input-group-xs" value="{{request()->query('pricestart')}}" /> to 
        <input type="text" id="priceend" name="priceend" size="3" value="{{request()->query('priceend')}}" /> <input type="button" id="priceupdate" value="update" class="btn btn-primary btn-sm" />
    <br /> <br />
    <span id="group-filter-size">
    <h4>Size (sqft)</h4>
    from <input type="text" id="sizestart" name="sizestart" size="3" value="{{request()->query('sizestart')}}" /> to  
        <input type="text" id="sizeend" name="sizeend" size="3" value="{{request()->query('sizeend')}}" /> <input type="button" id="sizeupdate" class="btn btn-sm btn-primary" value="update" />
    <br /> <br />
    </span>
    <span id="group-filter-forsaleby">
<h4>For Sale By</h4>
@if(request()->query('forsaleby') < 1)
       	<b>All</b><br />
       @else
       	<a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=0">All</a><br>
       @endif
       
       @if(request()->query('forsaleby') == 1)
       	<b>Owner</b><br />
       @else
    <a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=1">Owner</a><br>
     @endif
     
      @if(request()->query('forsaleby') == 2)
       	<b>Professional</b><br />
       @else
   <a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=2">Professional</a><br>
     @endif
     </span>
     <br />
     <span id="group-filter-forrentby">
<h4>For Rent By</h4>
@if(request()->query('forsaleby') < 3)
       	<b>All</b><br />
       @else
       	<a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=0">All</a><br>
       @endif
       
       @if(request()->query('forsaleby') == 3)
       	<b>Owner</b><br />
       @else
    <a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=3">Owner</a><br>
     @endif
     
      @if(request()->query('forsaleby') == 4)
       	<b>Professional</b><br />
       @else
   <a class="redirectme" href="{{Request::fullUrl()}}&forsaleby=4">Professional</a><br>
     @endif
     </span>
<br />


   
    <span id="group-filter-bedroom"> 
     <h4>Bedrooms</h4>
      <a id="selectMoreBedrooms" style="font-size: 200%" class="text-big" href="#">+</a>
    <div id="divHiddenFilterBedrooms" style="display: none;"> 
<input class="bedroomcls" type="checkbox" name="bedrooms-1" value="1" <?php if(in_array('1', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> Bachelor or studio<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-2" value="1" <?php if(in_array('2', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 1 bedroom<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-3" value="1" <?php if(in_array('3', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 1 bedroom and den<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-4" value="1" <?php if(in_array('4', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 2 bedrooms<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-5" value="1" <?php if(in_array('5', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 2 bedrooms and den<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-6" value="1" <?php if(in_array('6', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 3 bedrooms<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-7" value="1" <?php if(in_array('7', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 4 bedrooms<br />
<input class="bedroomcls" type="checkbox" name="bedrooms-8" value="1"<?php if(in_array('8', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?> /> 5 bedrooms<br />
<input type="checkbox" name="bedrooms-9" value="1" <?php if(in_array('9', explode(",", request()->query('bedrooms')))){?> CHECKED <?php } ?>/> 6 or more bedrooms<br />
<input type="button" id="bedroombtn" value="update" class="btn btn-sm btn-primary" />
</div><br /><br />
</span>

<span id="group-filter-bathroom"><h4>Bathrooms</h4>
  <a style="font-size: 200%" id="selectMoreBathrooms" class="text-big" href="#">+</a>
    <div id="divHiddenFilterBathrooms" style="display: none;">
    
 
<?php
 ?>
<input class="bathroomcls" type="checkbox" name="bathrooms-1" value="1" <?php if(in_array('1', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> Bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-2" value="1"<?php if(in_array('2', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?> /> 1 bathroom<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-3" value="1" <?php if(in_array('3', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 1.5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-4" value="1" <?php if(in_array('4', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 2 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-5" value="1" <?php if(in_array('5', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 2.5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-6" value="1" <?php if(in_array('6', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 3 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-7" value="1" <?php if(in_array('7', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 3.5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-8" value="1" <?php if(in_array('8', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 4 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-9" value="1" <?php if(in_array('9', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 4.5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-10" value="1" <?php if(in_array('10', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-11" value="1" <?php if(in_array('11', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 5.5 bathrooms<br />
<input class="bathroomcls" type="checkbox" name="bathrooms-12" value="1" <?php if(in_array('12', explode(",", request()->query('bathrooms')))){?> CHECKED <?php } ?>/> 6 or more bathrooms<br />
<input type="button" id="bathroombtn" value="update" class="btn btn-sm btn-primary" /><br />
</div><br /><br /></span>

<div id="parkingstorage">
<h4>Parking / Storage</h4>
<input class="parkingupdate" type="checkbox" name="parking" id="parking" value="1" <?php if(request()->query('parking') !== 0 && request()->query('parking')==1){?> CHECKED <?php } ?>/> Parking<br />

<input class="storageupdate" type="checkbox" name="storage" id="storage" value="1" <?php if(request()->query('storage') !== 0 && request()->query('storage')==1){?> CHECKED <?php } ?>/> Storage<br />
</div>

<div id="group-petfriendly">
<input class="petfriendlyupdate" type="checkbox" name="petfriendly" id="petfriendly" value="1" <?php if(request()->query('petfriendly') !== 0 && request()->query('petfriendly')==1){?> CHECKED <?php } ?>/> Pet Friendly<br />
</div>

<div id="group-furnished">
<input class="furnishedupdate" type="checkbox" name="furnished" id="furnished" value="1" <?php if(request()->query('furnished') !== 0 && request()->query('furnished')==1){?> CHECKED <?php } ?>/> Furnished<br />
</div>

    </div></div>
    </div></div>
        <div class="col-md-10">
        <nav class="navbar navbar-default">
                    <div class="container-fluid">
 
            <div class="card card-default" style="width: 100%">
            
            <div>
                <div class="card-header">Search</div>

               
                
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.css" rel="stylesheet">
<script>
$(function(){
	
	
	$('#radiusm').on('change', function (e) {
					e.preventDefault();
					$('#radius').val($(this).val());
					$('#addressupdate').click();
				
	});

	$('#address').on('change', function (e) {
					e.preventDefault();
				
					$('#addressupdate').click();
				
	});

	

	$('#bathroombtn').on('click', function (e) {
					e.preventDefault();
				
					sThisVal=[];
				
					$('input:checkbox.bathroomcls').each(function () {
					
      if(this.checked === true)
	  {
	  
		  temval=this.name.split('-');
		 sThisVal.push(temval[1]); 
	  }
 });
  	

					hrefs_base=window.location.href+"&bathrooms="+sThisVal.join(',');
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	$('#bedroombtn').on('click', function (e) {
					e.preventDefault();
					sThisVal=[];
				
					$('input:checkbox.bedroomcls').each(function () {
					
      if(this.checked === true)
	  {
	  
		  temval=this.name.split('-');
		 sThisVal.push(temval[1]); 
	  }
 });
  	

					hrefs_base=window.location.href+"&bedrooms="+sThisVal.join(',');
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	
	$('#radius').on('change', function (e) {
					//e.preventDefault();
				
					$('#addressupdate').click();
				
	});
	$('#addressupdate').on('click', function (e) {
					e.preventDefault();
				
					hrefs_base=window.location.href+"&address="+$("#address").val()+"&radius="+$("#radius").val();
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#priceupdate').on('click', function (e) {
					e.preventDefault();
					hrefs_base=window.location.href+"&pricestart="+$("#pricestart").val()+"&priceend="+$("#priceend").val();
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#sizeupdate').on('click', function (e) {
					e.preventDefault();
					hrefs_base=window.location.href+"&sizestart="+$("#sizestart").val()+"&sizeend="+$("#sizeend").val();
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#parking').on('click', function (e) {
					e.preventDefault();
					var parking=0;
				
					if($(this).is(":checked")) parking=1;
					hrefs_base=window.location.href+"&parking="+parking;
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#furnished').on('click', function (e) {
					e.preventDefault();
					var parking=0;
				
					if($(this).is(":checked")) furnished=1;
					hrefs_base=window.location.href+"&furnished="+furnished;
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#petfriendly').on('click', function (e) {
					e.preventDefault();
					var parking=0;
				
					if($(this).is(":checked")) petfriendly=1;
					hrefs_base=window.location.href+"&petfriendly="+petfriendly;
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
	
	$('#storage').on('click', function (e) {
					e.preventDefault();
					var storage=0;
					if($(this).is(":checked")) storage=1;
					hrefs_base=window.location.href+"&storage="+storage;
					var hrefs=hrefs_base.split('&');
					redirect_main(hrefs);
				
	});
					
	
	$('#selectMoreBedrooms').on('click', function (e) {
					e.preventDefault();
					
					if(!$('#divHiddenFilterBedrooms').is(":visible")){
						 $('#divHiddenFilterBedrooms').show();
						 $('#selectMoreBedrooms').text('-');
					}
					else {
						 $('#divHiddenFilterBedrooms').hide();
						$('#selectMoreBedrooms').text('+');
					}
                    
                 });
				 
	$('#selectMoreBathrooms').on('click', function (e) {
					e.preventDefault();
					
					if(!$('#divHiddenFilterBathrooms').is(":visible")){
						 $('#divHiddenFilterBathrooms').show();
						 $('#selectMoreBathrooms').text('-');
					}
					else {
						 $('#divHiddenFilterBathrooms').hide();
						$('#selectMoreBathrooms').text('+');
					}
                    
                 });
	
	$('#selectMoreLocations').on('click', function (e) {
					e.preventDefault();
					
					if(!$('#divHiddenFilterLocations').is(":visible")){
						 $('#divHiddenFilterLocations').show();
						 $('#selectMoreLocations').text('-');
					}
					else {
						 $('#divHiddenFilterBathroomsLocations').hide();
						$('#selectMoreLocations').text('+');
					}
                    
                 });
				 
	$('#selectMoreCategories').on('click', function (e) {
					e.preventDefault();
					
					
					
					if(!$('#divHiddenFilterCategories').is(":visible")){
						 $('#divHiddenFilterCategories').show();
						 $('#selectMoreCategories').text('-');
					}
					else {
						 $('#divHiddenFilterCategories').hide();
						$('#selectMoreCategories').text('+');
					}
                    
                 });
				 
	$('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
				 
	$('.redirectme').on('click', function (e) {
					e.preventDefault();
					var hrefs=$(this).attr('href').split('&');
					redirect_main(hrefs);
					
                
                 });
	
	
    $("#saveSearch").on("click", function(){

		var params=window.location.href.split('?');
		
        $.get("{{ url('/alerts/add?') }}" + encodeURI(params[1]), 
		function(data, status){
        	$("#saveSearch").attr('disabled', true);
    	});
    });
	
	//$("#listingtype").on("change", function(){
		
	//});
	$("#parkingstorage").hide();
	$("#group-petfriendly").hide();
	$("#group-furnished").hide();

	$("#group-filter-forrentby").hide();
	
	@if(request()->query('listingtype') == 1)
	 	

	 
		$("#group-filter-forsaleby").hide();
	
		$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
		
		//$("#group-petfriendly").show();
		//$("#group-furnished").show();
	
     	
	   
       	
       @endif
	
	@if(request()->query('listingtype') == 2)
	 	$("#group-petfriendly").show();
		$("#group-furnished").show();
		$("#group-filter-forrentby").show();
		
		$("#group-filter-forsaleby").hide();
		$("#group-filter-size").hide();
     	        	
       @endif
	
	@if(request()->query('listingtype') == 3)
	 	$("#group-petfriendly").show();
		$("#group-furnished").show();
		$("#group-filter-forrentby").show();
		
		$("#group-filter-forsaleby").hide();
		$("#group-filter-size").hide();
	
       	
       @endif
	
	@if(request()->query('listingtype') == 4)
	 	$("#group-petfriendly").show();
		$("#group-furnished").show();
		$("#group-filter-forrentby").hide();
		
		$("#group-filter-forsaleby").hide();
		$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       	
       @endif
	
	@if(request()->query('listingtype') == 5)
	
		$("#group-petfriendly").show();
		$("#group-furnished").show();
		$("#group-filter-forrentby").show();
		
		$("#group-filter-forsaleby").hide();
			$("#group-filter-size").hide();
	
		
       @endif
	
	 @if(request()->query('listingtype') == 6)
       	$("#group-furnished").show();
		$("#group-filter-forrentby").show();
		$("#group-filter-forsaleby").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       
	 
       	
       @endif
	
	 @if(request()->query('listingtype') == 7)
	 
     	  $("#parkingstorage").show();
		    $("#group-filter-forrentby").show();
		  
	   $("#group-filter-forsaleby").hide();
		$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       
       	
       @endif
	   
	   @if(request()->query('listingtype') == 8)
	 
     	  $("#parkingstorage").show();
		    $("#group-filter-forrentby").hide();
		  
	   $("#group-filter-forsaleby").show();
		$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       
       	
       @endif
	   
	 @if(request()->query('listingtype') == 9)
	 	
	   
       	
       @endif
	   
	 @if(request()->query('listingtype') == 10)

       	
       @endif
	   
	    @if(request()->query('listingtype') == 11)
	 	$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       	
       @endif
	   
	    @if(request()->query('listingtype') > 12)
		 $("#group-filter-forrentby").show();
	 	$("#group-filter-size").hide();
		$("#group-filter-bathroom").hide();
		$("#group-filter-bedroom").hide();
       	
       @endif
	   
	
	<?php //} ?>
	
});
function redirect_main(hrefs)
{
	var newhrefs=[];
	var newarr=[];
	for(x=0; x<hrefs.length; x++)
	{
		pieces=hrefs[x].split('=');
		newhrefs[pieces[0]]=pieces[1];						
	}
	
	var s='';
	for (var i in newhrefs) {
	   s += i + "=" + newhrefs[i] + "&";
	}
	

	if(s.charAt( s.length-1 ) == "&") {
		s = s.slice(0, -1)
	}


	window.location.href = s;
}
</script> 


             
    
    <script src="http://maps.google.com/maps/api/js?sensor=false&&key=AIzaSyA5Cf_1A9dWPdjkFRVdae7Ue9zDUHLfhzg" type="text/javascript"></script>               
             @if($Listings->total() > 0)     
                 <div id="map" style="height: 400px; width: 100%;">
                
</div>
<script type="text/javascript">    
      @if($LocationID > 0)
		 // document.getElementById("location-" + {{$LocationID}}).checked = false; 
	  @endif

    function refresh(id)
	{
		var url = window.location.href; 
		url = url.substring(0, url.indexOf('?'));

		window.location.href = url + '?location=' + id
		document.getElementById("location-" + id).checked = false;
	}
    var locations = [
	<?php $cnt=0; ?>
	@foreach($Listings as $Listing)
		<?php $cnt++;
		$addme='';
		if($Listing->photo1 != '') $addme.='<img align="top" style="height: 100px;" src="' . asset("images/listings/" . $Listing->photo1) . '" />';
		else $addme.='<img align="top" style="height: 100px;" src="' . asset("images/listings/noimage.jpg") . '" />';
		 ?>
        ['<div style="padding-right: 5px; float: right; color: #00FF00">$<?php echo $Listing->price; ?> </div><br><div style="border: 1px solid black; padding: 5px; width: 450px;"><h4><a href="{{ url("/listing/" . $Listing->id)}}">{{$Listing->name}}</a></h4><p><table><tr><td valign="top"><?php echo $addme; ?></td><td valign="top"><?php echo preg_replace( "/\r|\n/", "", (substr($Listing->description, 0, 255))); ?></td></tr></table><br></p></div>', {{$Listing->lat}}, {{$Listing->long}}, <?php echo $cnt; ?>]
		@if(!$loop->last)
         ,
        @endif
    @endforeach
    ];
	bounds = new google.maps.LatLngBounds();
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: new google.maps.LatLng({{isset($Listings[0]->lat) ? $Listings[0]->lat : 43.79 }}, {{isset($Listings[0]->long) ? $Listings[0]->long : -79}}),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
	  loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng()); 
	  bounds.extend(loc);
    }
map.fitBounds(bounds);
map.panToBounds(bounds);
</script>
       
                   <table width="100%" class="table table-default">
  
                            <tbody>
                            <tr>
                            <td>
                            @foreach($locations as $location)
      
      
    @endforeach
                           
                            </td></tr>
                            
                           @foreach($Listings as $Listing)
                           		<tr>
        					<td>
                            <table width="100%"><tr><td><a href="listing/{{$Listing->id}}">{{$Listing->name}} @if(isset($Listing->distance))({{round($Listing->distance)}} KM) @endif</a> | {{$Listing->Location->name}} | <?php
							
							
							$now = \Carbon\Carbon::now();
							echo $difference = ($Listing->created_at->diff($now)->days < 2)
								? $Listing->created_at->diffForHumans($now)
								: $Listing->created_at->format('m/d/Y');
							
							  
							?>
                            </td><td align="right">${{$Listing->price}}</td></tr>
                            </table>
                            </td></tr>
                            <tr><td>
                     
                            <br />
                             @if($Listing->photo1)
                	
                				<img id="mainphoto" style="height: 100px;" align="top" src="{{ asset("images/listings/" . $Listing->photo1)}}" />
                             @endif <?php echo substr($Listing->description, 0, 500); ?><?php if(strlen($Listing->description) > 500){ ?>...<?php } ?></td></tr>
                           @endforeach
                           <tr><td>
                           	{{ $Listings->links() }}
                           </td></tr>
                           <tr><td><input type="button" id="saveSearch" class="btn btn-danger" value="Add Email Alert" /></td></tr>
                           </tbody></table>
                           
                           

                  @else 
                	<p style="padding-left: 10px;">No Results found.  <br /><br /><br /><input type="button" id="saveSearch" class="btn btn-danger" value="Add Email Alert" /></p> 
                @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
 
@endsection
