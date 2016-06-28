@extends('layouts.app')

@section('content')
<html>
	
    <head>
        <title>UP Diliman</title>
        <style>
			.card {
				position:absolute;
				vertical-align: middle;
				horizontal-align: middle;
				border: .5px;
				border-radius: 10px;
				border-style:solid;
				height: 205px;
				width: 326px;
				transform: translate(-50%, -50%);
				top: 50%;
				left: 50%;
			}
			.upper {
				position:inherit;
				text-align: right;
				height: 84px;
				width:325px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}
			.lower {
				position:inherit;
				height: 112.5px;
				width:325px;
				top: 84px;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}
			
			.campus {
				position:inherit;
				right: 0px;
				margin-right:5px;
				font-family: "Verdana";
				color: #800000;
			}
			#UP {
				position:inherit;
				margin-top:5px;
			}
			#CU {
				position:inherit;
				margin-top:-20px;
			}
			#logo {
				position:inherit;
				left: 0px;
				margin-top:5px;
				margin-left:5px;
			}
			.details{
				position:inherit;
				left:0px;
				top: 0px;
				right: 70px;
				margin-top: 0px;
				text-align: center;
				
			}
			#pic {
				position:inherit;
				right: 0px;
				bottom: 0px;
				border: 5px solid white;
				margin-right: 6px;
				margin-bottom: 6px;
			}
			.imgback {
				position:inherit;
				right: 0px;
				bottom: 0px;
				height: 132px;
				width: 92px;
				background-color: red;
				margin-right: 5px;
				margin-bottom: 5px;
			}
			.bcode {
				position: inherit;
				bottom: 0px;
				right: 115px;
				margin-bottom: 5px;
			}
			button {
				position:absolute;
				background-color: maroon;
				bottom: 0px;
				right: 0px;
				border-radius: 20px;
				color: white;
				margin-top: 10px;
			}
			
        </style>
    </head>
    <body>
		
		<div class = "container">
			<div id="editor"></div>
			<div class = "card" id = "card">
				<div class = "upper">
				
					<img src = "/img/UPLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">University of the Philippines<br/>Diliman</label><br>
				</div>
				<div class = "lower">
					<div class = "details">
						<label>{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label>&nbsp<a href="{{ url('/ViewEmergency') }}"><i class="fa fa-btn fa-info-circle"></i></a><br>
						<label>{{$user->idnum}}<br/>{{$user->dept}}</label>
						
					</div>
					
				</div>
				<div class = "imgback">
					<img src = <?php echo "/img/".$user->idnum.".jpg"?> id = "pic" alt = "1x1" width = "80" height = "120">
				</div>
				<div>
					
				</div>
			<div class = "bcode">	
				<img src=<?php echo "barcode/img/".$user->idnum?> id="barcode" alt="barcode">
			</div>
			</div>
		</div>
    </body>
</html>
@endsection
