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
	<form class="form-horizontal" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
 						

                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Name *</label>
                                                       
                                                        <div class="col-md-10">
                                                                <input type="text" class="form-control" name="name" value="{{Input::old('name') ? Input::old('name') : Input::get('name')}}">
                                                        </div>
                                                </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
@endsection
