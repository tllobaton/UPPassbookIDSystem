<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Passbook ID</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }
		
		#navbarlogo {
			height: 70px;
			width: 70px;
		}
		
		#navbarlogo_xs{
			position: absolute;
			top: 0;
			left: 0;
			margin-left: 5px;
			margin-top: 5px;
			height: 70px;
			width: 70px;
		}
		
        .fa-btn {
            margin-right: 6px;
        }
		
		.navbar-default{
			background-color: #800000;
			margin-left: auto;
			margin-right: auto;
		}
		
		.navbar-left {
			font-family: 'Times New Roman';
			font-size: 25px;
			margin-left: 10px;
			margin-top: 5px;
			color: white;
		}
		
		.navbar-toggle{
			margin-top: 36px;
		}
		
		/*STYLE FOR ALL BUTTONS*/
		.btn{
			background-color: #800000;
			border: none;
			text-align: center;
			border-radius: 0px;
			color: white;
			margin: 5px;
			width: 150px;
		}
		.btn-primary:hover{
			background-color: #700000 !important;
		}
		
		.dropdown-toggle {
			margin-top: 10px;
			font-size: 20px;
		}
		
		#UPlogo{
			position: absolute;
			top: 0;
			left: 0;
			margin-left: 85px;
			margin-top: 20px;
		}
		
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-full navbar-inverse navbar-default navbar-fixed-top">
        <div class="container">
            <div id = "bars" class="navbar-header">

                <!-- Collapsed Hamburger -->
				@if(!Auth::guest())
					<button type="button" class="navbar-toggle collapsed row" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				@else
					<div class="visible-xs" style="background-color: #800000; width: 100%; height: 70px"></div>
				@endif

                <!-- Branding Image -->
				<h1 class="navbar-left"><img class="hidden-xs" id = "navbarlogo" src = "/UPPassbookIDSystem/PassbookID/public/img/UPLogo.png"><img class="visible-xs" id = "navbarlogo_xs" src = "/UPPassbookIDSystem/PassbookID/public/img/UPLogo.png"><span class="hidden-xs">UNIVERSITY OF THE PHILIPPINES</span><span class="visible-xs" id="UPlogo">U.P.</span></h1>
				<!--<a href = "#" class = "navbar-brand"></a>-->
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar 
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <!--<li><a href="{{ url('/login') }}">Login</a></li>-->
                        <!-- <li><a href="{{ url('/register') }}">Register</a></li>-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/Landing') }}"><i class="fa fa-btn fa-home"></i>Home</a></li>
								@if (Auth::user()->isadmin == 'yes')
									<li><a href="{{ url('/AdminView') }}"><i class="fa fa-btn fa-exchange"></i>Switch to Admin View</a></li>
									<li><a href="{{ url('/AdminCreate') }}"><i class="fa fa-btn fa-level-up"></i>Promote a User to Admin</a></li>
									<li><a href="{{ url('/AdminRemove') }}"><i class="fa fa-btn fa-user-times"></i>Remove a User's Admin Status</a></li>
									<li><a href="{{ url('/AdminCampDept') }}"><i class="fa fa-btn fa-university"></i>Add Campus/Department</a></li>
									<li><a href="{{ url('/AdminExpire') }}"><i class="fa fa-btn fa-clock-o"></i>Set ID Expiration Date</a></li>
									<li><a href="{{ url('/AdminDeleteUsers') }}"><i class="fa fa-btn fa-user-times"></i>Activate/Deactivate Users</a></li>
									<li><a href="{{ url('/AdminAddUsers') }}"><i class="fa fa-btn fa-file"></i>Import CSV file</a></li>
								@endif
								<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
