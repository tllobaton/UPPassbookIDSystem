@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			.card {
				position:absolute;
				transform: translate(-50%, -50%);
				top: 50%;
				left: 50%;
				border: .5px;
				border-radius: 10px;
				border-style:solid;
				height: 205px;
				width: 326px;
			}
			.upper {
				position:inherit;
				text-align: right;
				height: 92.5px;
				width:325px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}
			.lower {
				position:inherit;
				height: 112.5px;
				width:325px;
				top: 92.5px;
				background-color: #800000;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}
			
			.campus {
				position:inherit;
				right: 0px;
				margin-right:5px;
				font-family: "Times New Roman";
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
				right: 100px;
				margin-top: 5px;
				text-align: center;
				color: white;
				
			}
			#pic {
				position:inherit;
				right: 0px;
				bottom: 0px;
				border: 2px solid #800000;
				margin-right: 5px;
				margin-bottom: 5px;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<div class = "upper">
					<img src = "/img/UPLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">UNIVERSITY OF THE PHILIPPINES<br/>VISAYAS</label><br>
				</div>
				<div class = "lower">
					<div class = "details">
						<label>{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label>&nbsp<a href="{{ url('/ViewEmergency1') }}"><i class="fa fa-btn fa-info-circle"></i></a><br>
						<label>{{$user->sn_year}}-{{$user->sn_num}}<br/>{{$user->dept}}</label>
					</div>
					
				</div>
				<img src = <?php echo "/img/".$user->sn_year.$user->sn_num.".jpg"?> id = "pic" alt = "1x1" width = "120" height = "120">
			</div>
		</div>
		
    </body>
</html>
@endsection
