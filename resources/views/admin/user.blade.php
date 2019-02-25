@extends('layouts/admin2')

@section('Title', $Title)




@section('content')
	<h4>{{$Title}}</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!--
	<strong>Last Updated: {{Input::get('updated_at')}}{{Input::old('updated_at')}}</strong><br>
	<strong>Created: {{Input::get('created_at')}}{{Input::old('created_at')}}</strong><br><br>-->
	<form class="form-horizontal" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
    							
 						

                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Name *</label>
                                                       
                                                        <div class="col-md-10">
                                                                <input type="text" class="form-control" name="name" value="{{Input::old('last_name') ? Input::old('last_name') : Input::get('name')}}">
                                                        </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Email</label>
                                                       
                                                        <div class="col-md-10">
                                                                <input type="text" class="form-control" name="email" value="{{Input::old('email') ? Input::old('email') : Input::get('email')}}">
                                                        </div>
                                                </div>
                                                
                                                 <div class="form-group">
                                                        <label class="col-md-2 control-label">First Name *</label>
                                                       
                                                        <div class="col-md-10">
                                                                <input type="text" class="form-control" name="first_name" value="{{Input::old('first_name') ? Input::old('first_name') : Input::get('first_name')}}">
                                                        </div>
                                                </div>

                                                
                                                
                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Last Name *</label>
                                                       
                                                        <div class="col-md-10">
                                                                <input type="text" class="form-control" name="last_name" value="{{Input::old('last_name') ? Input::old('last_name') : Input::get('last_name')}}">
                                                        </div>
                                                </div>
                                                
                                                
                                               

                                                


                                                

                                                

 						



                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">UserType</label>
                                                        <div class="col-md-10">
								 <select name="role" class="form-control">
									<option value="0">User</option>
                                                                        <option value="1"@if(Input::get('role') == 1 || old('role') == 1) SELECTED @endif>Admin</option>
                                                                </select>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Password</label>
                                                        <div class="col-md-10">
                                                                <input type="password" class="form-control" name="password">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Confirm Password</label>
                                                        <div class="col-md-10">
                                                                <input type="password" class="form-control" name="password_confirmation">
                                                        </div>
                                                </div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
@endsection
