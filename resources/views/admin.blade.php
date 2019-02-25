@extends('layouts/admin2')

@section('Title', $Title)

<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-2">
        @section('sidemenu')
                                <a href="/admin/users">Users</a><br>
                                <a href="/admin/listings">Listings</a>

@endsection
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header"></div>

               	@section('content')
            Welcome
            @endsection

                  
                </div>
            </div>
        </div>
    </div>
</div>



