<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>	
       <script src="/js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <script src="/js/bootstrap.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
		
		var mtype='{{isset($mtype) ?  $mtype: '' }}';
		
		$(document).on("click", ".moveitem", function(e){
			
			
			e.preventDefault();
		
			var item=$(this).attr('id').split('-');
			 console.log("{{ url('/admin/move/')}}/" + mtype + '/' + item[2] + '/id/' + item[1]);
			$.get( "{{ url('/admin/move/')}}/" + mtype + '/' + item[2] + '/id/' + item[1], function( data ) {
				 
				
			});
		
			if(item[2] == "down")
			{
				
				
				
				var current=$("#row-"+item[1]);
				var other = $("#row-"+item[1]).next();		
				other.after(current.clone());
				current.remove();
				
				var itemnamefirst=$(".moveitem").first().attr('id').split('-');
				var itemnamelast=$(".moveitem").last().attr('id').split('-');
				
				
				if($("#row-"+item[1]).attr('id') == $("#row-"+itemnamefirst[1]).attr('id'))
				{
					$("#item-" + item[1] + "-up").hide();
					$("#item-" + item[1] + "-down").show();
					
				}
				else if($("#row-"+item[1]).attr('id') == $("#row-"+itemnamelast[1]).attr('id'))
				{
					$("#item-" + item[1] + "-down").hide();
					$("#item-" + item[1] + "-up").show();
				}
				else {
					$("#item-" + item[1] + "-down").show();
					$("#item-" + item[1] + "-up").show();
				}
				
				
				var itemotherid=other.attr('id').split('-');
		
				if(other.attr('id') == $("#row-"+itemnamefirst[1]).attr('id'))
				{
			
					
					$("#item-" + itemotherid[1] + "-up").hide();
					$("#item-" + itemotherid[1] + "-down").show();
					
				}
				else if(other.attr('id') == $("#row-"+itemnamelast[1]).attr('id'))
				{

					$("#item-" + itemotherid[1] + "-down").hide();
					$("#item-" + itemotherid[1] + "-up").show();
				}
				else {
		
					$("#item-" + itemotherid[1] + "-down").show();
					$("#item-" + itemotherid[1] + "-up").show();
				}
			
			}
			if(item[2] === "up")
			{
				var current=$("#row-"+item[1]);
				var other = $("#row-"+item[1]).prev();		
				other.before(current.clone());
				current.remove();
				
				var itemnamefirst=$(".moveitem").first().attr('id').split('-');
				var itemnamelast=$(".moveitem").last().attr('id').split('-');
				
				
				if($("#row-"+item[1]).attr('id') == $("#row-"+itemnamefirst[1]).attr('id'))
				{
					$("#item-" + item[1] + "-up").hide();
					$("#item-" + item[1] + "-down").show();
					
				}
				else if($("#row-"+item[1]).attr('id') == $("#row-"+itemnamelast[1]).attr('id'))
				{
					$("#item-" + item[1] + "-down").hide();
					$("#item-" + item[1] + "-up").show();
				}
				else {
					
					$("#item-" + item[1] + "-down").show();
					$("#item-" + item[1] + "-up").show();
				}
				
				
				var itemotherid=other.attr('id').split('-');
			
				if(other.attr('id') == $("#row-"+itemnamefirst[1]).attr('id'))
				{
		
					
					$("#item-" + itemotherid[1] + "-up").hide();
					$("#item-" + itemotherid[1] + "-down").show();
					
				}
				else if(other.attr('id') == $("#row-"+itemnamelast[1]).attr('id'))
				{
			
					$("#item-" + itemotherid[1] + "-down").hide();
					$("#item-" + itemotherid[1] + "-up").show();
				}
				else {
		
					$("#item-" + itemotherid[1] + "-down").show();
					$("#item-" + itemotherid[1] + "-up").show();
				}
				
				
			}
			
		
			
			
		});


	    $('#box').keyup(function(){
       var valThis = $(this).val().toLowerCase();
	if(valThis.length > 1 || valThis.length == 0){
        $('#contentList>li').each(function(){
         var text = $(this).text().toLowerCase();
            (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();         
       	  });
	}
    	});
	
});
	</script>
    <style>
	.up {
    transform: rotate(-135deg);
    -webkit-transform: rotate(-135deg);
}

.down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}

i {
    border: solid black;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
}
	</style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Real Estate Website
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    	<li><a class="nav-link" href="{{ url('/admin') }}">Admin Home</a></li> 
                        <li><a class="nav-link" href="{{ url('/admin/users') }}">Users</a></li>
                        <li><a class="nav-link" href="{{ url('/admin/listings') }}">Listings</a></li>
                        <li><a class="nav-link" href="{{ url('/admin/categories') }}">Listing Categories</a></li>
                        <li><a class="nav-link" href="{{ url('/admin/regions') }}">Regions</a></li>
                        <li><a class="nav-link primary" href="{{ url('/') }}">Public Area Home</a></li>
                        
                       
                        

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                      
                            <li class="nav-item dropdown">
                            
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                               
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                                 @if(Auth::user()->role > 0)
                                <a class="dropdown-item" href="{{ url('/admin') }}">
                                        ADMIN 
                                    </a>
                                  @endif 
                                <a class="dropdown-item" href="{{ url('/MyListings') }}">
                                        My Listings
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/MyAlerts') }}"">
                                        My Alerts
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/MyAccount') }}"">
                                        My Account
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header"><h2>@yield('Title')</h2></div>

                <div class="card-body">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                   
				@yield('content')
                  
                </div>
            </div>
        </div>
    </div>





    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
