@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function(){
	
	
    $(".deletelisting").on("click", function(e){
	 	e.preventDefault();
		
		var id=$(this).attr('id').split('listing-');
		alert(id);
		$.post("'{{ asset('/listing/delete/') }}'+id", {}, function(result){
			$("#row-" + id).hide();	
    	});
       
    });
});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">My Listings</div>

                <div class="card-body">
               
                      		<table class="table table-striped">
                            <thead>
                            <tr><th>Title</th><th>Date Created</th><th></th>
                            </tr>
                            </thead>
                            <tbody>
                            
                           @foreach($Listings as $Listing)
                           		<tr>
                                
        					<td><a href="{{ url('/listing/')}}/{{$Listing->id}}">{{$Listing->name}}</a><br />
                            {{$Listing->description}}</td><td>{{$Listing->created_at->diffForHumans()}}</td><td>[<a id="/listings/{{$Listing->id}}" href="{{ url('/listing/' . $Listing->id) }}">view</a>][<a href="{{ url('/listing/edit/') }}/{{$Listing->id}}">edit</a>] [<a class="deletelisting" id="listing-{{$Listing->id}" href="#">delete</a>]</td></tr>
                           @endforeach
                           </tbody></table>
                    
           
                    
                    
                    
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
