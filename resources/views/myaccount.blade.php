@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">My Account</div>
                <div class="card-body">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                @if($errors->all())
                <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
                
                <br />
             
                <div style="border: 1px black">
                        
                   <form action="{{ url('/MyAccount') }}" method="post" enctype="multipart/form-data">
                   @csrf
                   <div class="form-group">
                   <label for="first_name">First Name</label>
  					<input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}">
                    <label for="last_name">Last Name</label>
  					<input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                    </div>
                    
                    <div class="form-group">
                   <label for="password">Password</label>
  					<input type="password" class="form-control" id="password" name="password" value="">
                    <label for="last_name">Password (again)</label>
  					<input type="password" class="form-control" id="password2" name="password2" value="">
                    </div>
                    
                    
                   
                  
                    <div class="form-group">
                     <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
  	
                   <input type="submit" name="" value="Save" class="btn btn-primary form-control" />
                   </div>
                   </form>
                   </div>
             

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
