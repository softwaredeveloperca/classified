@extends('layouts/admin2')

@section('Title', $Title)



@section('content')
	Total: {{count($Users)}}<br>
	<div class="form-group">
		
    		<input type="text" value="" class="form-control" id="box" placeholder="Start Typing to Search..">
  	</div>
	<ul class="list-group" id="contentList">
	@foreach($Users as $User)
	<li class="list-group-item">
	<h3>{{$User->name}}</h3>


<a class="btn btn-primary btn-sm" href="{{ url('/admin/user/edit/' . $User->id)  }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{ url('/admin/user/delete/{' . $User->id)  }}">Delete</a>
	</li>
	@endforeach
	</ul>
	<p class="navbar-btn">
                    <a href="{{ url('/admin/user/add') }}" class="btn btn-default">Add User</a>
                </p>
@endsection
