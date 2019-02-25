@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function(){
	var cnt=1;
	<?php if(!isset($id)){ ?>
    
	
	
	$(".moreParamslink").on("click", function(e){
			e.preventDefault();
			id=$(this).attr('id').split('-');
			$(this).hide();
			$("#moreParams-"+id[1]).show();			  
		
    });
	
	$(".deletealerts").on("click", function(){
		$yes=confirm("Are you sure you want to delete this alert?");
		if($yes)
		{
			id=$(this).attr('id').split('-');
		
				$.get( "{{ url('/') }}/alert/delete/" + id[1], function( data ) { 
				$("#row-"+id[1]).hide(); 
			});    
		}
    });
	
	<?php } ?>
});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">My Alerts</div>

                <div class="card-body">
               
                        <table class="table table-striped">
 					<thead><tr>
                    <th>From</th> 
                      <th>Total Number</th>
                       <th>Number of New</th>  <th width="40%">Parameters</th>
                       <!--<th>Delivery</th>-->
                    
                       <th></th>
                       
                    </thead>
                            <tbody>
                            
                            
                           @foreach($Alerts as $Alert)
                           		<tr id="row-{{$Alert->id}}"><td>
                            {{$Alert->created_at->diffForHumans()}}</td>
        					
                            <td><a href="{{ url('/search')}}?/{{$Alert->search_string}}">{{$Alert->totalnumber}}</a></td>
                            <td><a href="{{ url('/search')}}?/{{$Alert->search_string}}&created_at={{$Alert->created_at}}">{{$Alert->totalnew}}</a></td>
                            <td width="100">
                            {{$Alert->new_search_string}}
                           </div>
                            
                            </div>
                            
                            </td>
                            <!--<td>
                            <input type="radio" id="delivery-{{$Alert->id}}" class="delivery" name="delivery" value="1" @if($Alert->delivery == 1) checked="1" @endif /> Instant <br />
                            <input type="radio" id="delivery-{{$Alert->id}}" class="delivery" name="delivery" value="2" @if($Alert->delivery == 2) checked="1" @endif /> Daily <br />
                            <input type="radio" id="delivery-{{$Alert->id}}" class="delivery" name="develery" value="3" @if($Alert->delivery == 3) checked="1" @endif /> Weekly 
                            </td>-->
                            
                            <td><input type="button" id="alert-{{$Alert->id}}" class="deletealerts btn btn-danger" value="delete"></td></tr>
                           @endforeach
                           </tbody></table>
                    
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
