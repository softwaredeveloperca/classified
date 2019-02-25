@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header"></div>

                <div class="card-body">
                   <div class="jumbotron">
                   <img width="500" src="{{url('/images/condo.png')}}" />
                  
 
    <p>A small description on what this website does and doesn't do.  A small description on what this website does and doesn't do.  A small description on what this website does and doesn't do.</p>
  </div>
    <form action="search" method="get">
    <input type="hidden" name="a" value="" />
    <input type="hidden" name="radius" value="50" />
 <table width="100%"><tr><td style="padding: 10px;" valign="top">
                 
                   <label for="location">Location:</label>
  <select class="form-control" id="location" name="location">
  	@foreach($locations as $location)
      
      <option value="{{$location->id}}">{{$location->name}}</option>
    @endforeach
    </select>
    
    <br />
    <label for="location">Catgegories:</label>
  <select class="form-control" id="listingtype" name="listingtype">
  	@foreach($types as $location)
      
      <option value="{{$location->id}}">{{$location->name}}</option>
    @endforeach
    </select>
    
    <br />
    <label for="address">Address:</label>
                   <input class="form-control" type="text" name="address" id="address" value="" placeholder="Type an address" />
                   </tr>
                   <tr><td><br /><input type="submit" name="" value="Find" class="btn btn-primary form-control" /></td></tr>
                   </table>
                   </form><br />
                  
               
               </td><td style="padding: 10px;" valign="middle">
               
               
                   
                   <div class="panel panel-warning">
                   <div class="panel-heading text-center"><br /><br /><br /><h2>Latest Listings</h2></div>
                   <div class="panel-body">
                   <table class="table table-default">
  
                            <tbody>
                            
                            
                           @foreach($Listings as $Listing)
                           		<tr>
        					<td><a href="listing/{{$Listing->id}}">{{$Listing->name}}</a><br />
                            @if($Listing->photo1)
                	
                				<img id="mainphoto" style="height: 50px;" align="top" src="{{ asset("images/listings/" . $Listing->photo1)}}" />
                             @endif
                    {{substr($Listing->description,0,400)}}</td></tr>
                           @endforeach
                           
                           </tbody></table>
                   </div>
                   </div>

                  
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
