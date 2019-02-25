@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Create</div>

                <div class="card-body">
               
                        <div class="alert alert-success">
                            The listings was submitted.  The listing will be approved shortly.
                            <br /><br />
                            <a href="listings/{{$listing_id}}">View Listing</a>
                        </div>
           
                    
                    
                    
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
