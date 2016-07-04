@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
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
				position:absolute;
				text-align: right;
				height: 84px;
				width:325px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}
			.lower {
				position:absolute;
				height: 112.5px;
				width:325px;
				top: 84px;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}
			
			.campus {
				position:absolute;
				right: 0px;
				margin-right:5px;
				font-family: "Verdana";
				color: #800000;
			}
			#UP {
				position:absolute;
				margin-top:5px;
			}
			#CU {
				position:absolute;
				margin-top:-20px;
			}
			#logo {
				position:absolute;
				left: 0px;
				margin-top:5px;
				margin-left:5px;
				height: auto;
			}
			.details{
				position:absolute;
				left:0px;
				top: 0px;
				right: 95px;
				margin-top: 5px;
				text-align: center;
				
			}
			#pic {
				position:absolute;
				right: 0px;
				bottom: 0px;
				border: 5px solid white;
				margin-right: 6px;
				margin-bottom: 6px;
			}
			.imgback {
				position:absolute;
				right: 0px;
				bottom: 0px;
				height: 132px;
				width: 92px;
				background-color: red;
				margin-right: 5px;
				margin-bottom: 5px;
			}
			.info{
				position: absolute;
				right: 0px;
				bottom: 0px;
				margin-right: 1px;
				margin-bottom: 3px;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<div class = "upper">
					<img src = "/img/UPLBLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">University of the Philippines<br/>LOS BAÑOS</label><br>
				</div>
				<div class = "lower">
					<div class = "details">
						<label>{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label><br>
						<label>{{$user->sn_year}}-{{$user->sn_num}}<br/>{{$user->dept}}</label>
					</div>
					
				</div>
				<div class = "imgback">
					<img src = <?php echo "/img/".$user->idnum.".jpg"?> id = "pic" alt = "1x1" width = "80" height = "120">
				</div>
				<span class="info"><a href="{{ url('/ViewEmergency1') }}"><i class="fa fa-btn fa-info-circle"></i></a></span>
			</div>
		</div>
		
    </body>
</html>
@endsection
