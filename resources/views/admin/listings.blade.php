@extends('layouts/admin2')

@section('Title', $Title)



@section('content')
	Total: {{count($Listings)}}<br>
    @if($approved != 1) <a href="{{ url('/admin/listings/approved') }}">view unapproved</a><br /> @else <a href="{{ url('/admin/listings')}}">view all</a><br /> @endif
    <p class="navbar-btn">
                    <a href="{{ url('/admin/listing/add') }}" class="btn btn-default">Add Listing</a>
                </p><br />
	<div class="form-group">
		
    		<input type="text" value="" class="form-control" id="box" placeholder="Start Typing to Search..">
  	</div>
	<ul class="list-group" id="contentList">
	@foreach($Listings as $listing)
	<li class="list-group-item">
	<h3>{{$listing->name}}</h3>


<a class="btn btn-primary btn-sm" href="{{ url('/admin/listing/edit/' . $listing->id)  }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{ url('/admin/listing/delete/' . $listing->id)  }}">Delete</a>

@if($listing->approved==0)
<a class="btn btn-danger btn-sm"  href="{{ url('/admin/listing/approve/' . $listing->id)  }}">Approve</a>
@else
<a class="btn btn-danger btn-sm"  href="{{ url('/admin/listing/unapprove/' . $listing->id)  }}">Unapprove</a>
@endif

	</li>
	@endforeach
	</ul>
	
@endsection
