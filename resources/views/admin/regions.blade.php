@extends('layouts/admin2')

@section('Title', $Title)



@section('content')


	Total: {{count($Regions)}}<br>
    <p class="navbar-btn">
                    <a href="{{ url('/admin/region/add') }}" class="btn btn-default">Add Regions</a>
                </p><br />
	<div class="form-group">
		
    		<input type="text" value="" class="form-control" id="box" placeholder="Start Typing to Search..">
  	</div>
	<ul class="list-group" id="contentList">
    
	@foreach($Regions as $region)
	<li class="list-group-item" id="row-{{$region->id}}">
	<h3>{{$region->name}}</h3>
[ 

<a id="item-{{$region->id}}-up" class="moveitem" href="#"@if ($loop->first) style="display: none;" @endif><i class="arrow up"></i></a>


  

<a id="item-{{$region->id}}-down" class="moveitem" href="#"@if ($loop->last) style="display: none;" @endif><i class="arrow down"></i></a>  

 ]
<a class="btn btn-primary btn-sm" href="{{ url('/admin/region/edit/' . $region->id)  }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{ url('/admin/region/delete/' . $region->id)  }}">Delete</a>
	</li>
	@endforeach
	</ul>
	
@endsection
