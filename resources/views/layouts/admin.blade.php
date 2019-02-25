<html>
        <head>
                <title>Admin - @yield('Title')</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <script src="/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){



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
        </head>
        <body>
 <nav class="navbar navbar-default">
                <div class="container-fluid">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle Navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Admin</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                        <li><a href="{{ url('/admin') }}">Admin Home</a></li>
<li><a href="{{ url('/admin/cities') }}">Cities</a></li>
<li><a href="{{ url('/admin/provinces') }}">Provinces</a></li>
<li><a href="{{ url('/admin/regions') }}">Regions</a></li>
<li><a href="{{ url('/admin/users') }}">Users</a></li>
<li><a href="{{ url('/admin/attractions') }}">Attractions</a></li>
<li><a href="{{ url('/admin/attractiontypes') }}">Types</a></li>
<li><a href="{{ url('/admin/associations') }}">Associations</a></li>
<li><a href="{{ url('/admin/commodities') }}">Commodities</a></li>
<li><a href="{{ url('/admin/draws') }}">Draws</a></li>
<li><a href="{{ url('/admin/topofpage') }}">Premium</a></li>
<li><a href="{{ url('/admin/reports') }}">Reports</a></li>
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                        @if (Auth::guest())
                                                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                                                <li><a href="{{ url('/auth/register') }}">Register</a></li>
                                        @else
                                                <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						
                                                        <ul class="dropdown-menu" role="menu">
                                               		<li><a href="{{ url('/') }}">Public Site</a></li>

					                 <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                                                        </ul>
                                                </li>
                                        @endif
                                </ul>
                        </div>
                </div>
        </nav>
<div class="container">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
	<div class="row">
		<div class="col-md-2">
			<div class="panel panel-default">

				<div class="panel-heading">Menu</div>
				<div class="panel-body">
				@yield('sidemenu')
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">@yield('Title')</div>

				<div class="panel-body">
	
				@yield('content')

				</div>
			</div>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

