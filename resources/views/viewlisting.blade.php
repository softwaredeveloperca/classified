@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">View</div>
                 <script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyA5Cf_1A9dWPdjkFRVdae7Ue9zDUHLfhzg" type="text/javascript"></script> 
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
                 
                  <script src="http://maps.google.com/maps/api/js?sensor=false&&key=AIzaSyA5Cf_1A9dWPdjkFRVdae7Ue9zDUHLfhzg" type="text/javascript"></script> 
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>              
                  
             
                 <div id="map" style="height: 250px; width: 100%;">
</div>
<script type="text/javascript">    
   

    function refresh(id)
	{
		var url = window.location.href; 
		url = url.substring(0, url.indexOf('?'));

		window.location.href = url + '?location=' + id
		document.getElementById("location-" + id).checked = false;
	}
    var locations = [
	<?php $cnt=0; ?>
	
		<?php $cnt++; ?>
        ['<h2>{{$Listing['name']}}</h2><p>{{str_limit($Listing['description'], 255)}}</p>', {{$Listing['lat']}}, {{$Listing['long']}}, <?php echo $cnt; ?>]

    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng({{$Listing['lat']}}, {{$Listing['long']}}),
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
    }
	
	$(document).ready(function(){

   // jQuery methods go here...
   	$('.changepic').click(function(e){
		e.preventDefault();
	
    	$("#mainphoto").removeAttr('src').attr('src', $(this).attr('src')+'?'+Math.random());
	
    });
	
	$('.revealphone').click(function(e){
		e.preventDefault();
	
		var val=$(this).attr('id').split('split');
		
		$("#phone_textsplit"+val[1]).text(val[1]);
		$(this).hide();
    	
	
    });
	
	

	}); 

</script>

                <div class="card-body">
                 @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                <h2>{{$Listing['name']}}</h2>
                <p>{{$Listing['description']}}</p>
                
               
            
                <span class="badge badge-default">@if($Listing['status']== 1) Approved @else Not Approved @endif</span>
                
                @if($Listing['photo1'])
                	<table><tr><td width="50%" style="padding: 10px">
                	<img id="mainphoto" src="{{ asset("images/listings/" . $Listing['photo1'])}}" />
                    </td>
                    <td width="50%" valign="top" style="padding: 10px">
                    	<?php for($x=1; $x<10; $x++){ ?>
                    	@if($Listing['photo'.$x]) <img<?php if($x==1){ ?> style="border: 1px #000"<?php } ?> class="changepic" id="photo_{{$x}}" height="50" src="{{ asset("images/listings/" . $Listing['photo'.$x])}}" /> @endif
                        <?php } ?>
                    </td></tr>
                @endif
                </table>
                 </p>
             
         
                              @if($Listing['email']) Email: <a href="{{$Listing['email']}}"><?php echo substr($Listing['email'], 0, -4) . 'xxxx'; ?></a><br /> @endif
                           @if($Listing['phone']) Phone: <span id="phone_textsplit{{$Listing['phone']}}"><?php echo substr($Listing['phone'], 0, -4) . 'xxxx'; ?></span> <input type="button" name="revealphone" class="revealphone btn btn-sm" id="revealphonesplit{{$Listing['phone']}}" value="Reveal" /><br /> @endif
                          @if($Listing['youtube']) Youtube: <a href="{{$Listing['youtube']}}">{{$Listing['youtube']}}</a><br /> @endif
                           @if($Listing['website']) Website: <a href="{{$Listing['website']}}">{{$Listing['website']}}</a><br /> @endif
                     
                            @if($Listing['bedrooms']) Bedroom(s): 
                            <?php
							switch($Listing['bedrooms'])
							{
								case 1:
									?>Bachelor or studio<?php
									break;
								case 2:
									?>1 bedroom<?php
									break;
								case 3:
									?>1 bedroom and den<?php
									break;
								case 4:
									?>2 bedrooms<?php
									break;
								case 5:
									?>2 bedrooms and den<?php
									break;
								case 6:
									?>3 bedrooms<?php
									break;
								case 7:
									?>4 bedrooms<?php
									break;
								case 8:
									?>5 bedrooms<?php
									break;
								case 9:
									?>6 or more bedrooms<?php
									break;
							}
							?>
                            <br /> @endif
                             @if($Listing['bathrooms']) Bathrooms: 
                             <?php
							switch($Listing['bathrooms'])
							{
								case 1:
									?> Bathrooms<?php
									break;
								case 2:
									?>1 bathroom<?php
									break;
								case 3:
									?>1.5 bathrooms<?php
									break;
								case 4:
									?>2 bathrooms<?php
									break;
								case 5:
									?>2.5 bathrooms<?php
									break;
								case 6:
									?>3 bathrooms<?php
									break;
								case 7:
									?>3.5 bathrooms<?php
									break;
								case 8:
									?>4 bathrooms<?php
									break;
								case 9:
									?>4.5 bathrooms<?php
									break;
								case 10:
									?>5 bathrooms<?php
									break;
								case 11:
									?>5.5 bathrooms<?php
									break;
								case 11:
									?>6 or more bathrooms<?php
									break;
							}
							?><br /> @endif
                             
                             @if($Listing['forsaleby'] == 1 ) For Sale By: Owner<br /> @endif
                             @if($Listing['forsaleby'] == 2 ) For Sale By: Professional<br /> @endif
                              @if($Listing['forsaleby'] == 3 ) For Rent By: Owner<br /> @endif
                             @if($Listing['forsaleby'] == 4 ) For Rent By: Professional<br /> @endif
         
          @if($Listing['parking']==1) <span class="badge">Parking</span> <br /> @endif
           @if($Listing['storage']==1) <span class="badge">Storage</span> <br /> @endif
            @if($Listing['petfriendly']==1) <span class="badge">Pet Friendly</span><br /> @endif   
              @if($Listing['furnished']==1) <span class="badge">Furnished</span><br /> @endif                    
                 
                 <br /><br />
                 <h4>Contact</h4>
                 <form action="{{ url('/Listing/' . $Listing['id'] .'/Contact/') }}" method="post">
               <div class="form-inline">
                 <label class="control-label col-sm-1" for="name">Name: </label>
             
                 <input type="text" required class="col-sm-5 form-control" id="name" name="name" value="" placeholder="Name" />
                 <label class="control-label col-sm-1"  for="email">Email: </label><input type="email" class="col-sm-5 form-control" id="email" name="email" value="" required placeholder="email@address.com" />
                 </div>
              
              
                 	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                 <textarea class="form-control" name="comment" rows="6" cols="80"></textarea>
                 
                 <input type="submit" class="form-control" name="send" value="Send" />
                 </form>
                   
                  
                   
                   
                   
                   
           
                    
                    
                    
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
