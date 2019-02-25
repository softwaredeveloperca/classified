@extends('layouts/admin2')

@section('Title', $Title)



@section('content')
	Total: {{count($CategoryListings)}}<br>
    <p class="navbar-btn">
                    <a href="{{ url('/admin/category/add') }}" class="btn btn-default">Add category</a>
                </p><br />
	<div class="form-group">
		
    		<input type="text" value="" class="form-control" id="box" placeholder="Start Typing to Search..">
  	</div>
	<ul class="list-group" id="contentList">
	@foreach($CategoryListings as $category)
	<li class="list-group-item" id="row-{{$category->id}}">
	<h3>{{$category->name}}</h3>
[ 

<a id="item-{{$category->id}}-up" class="moveitem" href="#"@if ($loop->first) style="display: none;" @endif><i class="arrow up"></i></a>


  

<a id="item-{{$category->id}}-down" class="moveitem" href="#"@if ($loop->last) style="display: none;" @endif><i class="arrow down"></i></a>  

 ]

<a class="btn btn-primary btn-sm" href="{{ url('/admin/category/edit/' . $category->id)  }}">Edit</a> @if($category->id > 11) <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{ url('/admin/category/delete/' . $category->id)}}">Delete</a>
	@endif</li>
	@endforeach
	</ul>
	<p class="navbar-btn">
                    <a href="{{ url('/admin/category/add') }}" class="btn btn-default">Add category</a>
                </p>
@endsection
