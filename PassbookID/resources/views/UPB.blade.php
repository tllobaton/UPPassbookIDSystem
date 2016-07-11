@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			.card {
				position:absolute;
				border: .5px;
				transform: translate(-50%, -50%);
				top: 50%;
				left: 50%;
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
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}
			
			.campus {
				position:inherit;
				left: 0px;
				margin-left:28%;
				text-align: left;
				font-family: "Times New Roman";
			}
			#UP {
				position:inherit;
				margin-top:5px;
				color: #800000;
				font-size: 18px;
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
				right: 120px;
				margin-top: 5px;
				text-align: center;
				
			}
			#pic {
				position:inherit;
				right: 0px;
				bottom: 0px;
				border: 2px solid #800000;
				margin-right: 20px;
				margin-bottom: 20px;
			}
			.info{
				position: absolute;
				right: 0px;
				bottom: 0px;
				margin-right: 1px;
				margin-bottom: 3px;
			}
			
			#dl {
				position:absolute;
				bottom:0px;
				right: 0px;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<div class = "upper">
					<img src = "/img/UPLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">University of the Philippines<br/>Baguio</label><br>
				</div>
				<div class = "lower">
					<div class = "details">
						<label>{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label><br>
						<label>Student #: {{$user->sn_year}}-{{$user->sn_num}}</label><br/>
						<label>{{$user->dept}}</label>
					</div>
				</div>
				@if($user->isemployed=='yes')
					<img src = <?php echo 'wallet//'.$user->empnum.'/thumbnail.png'?> id = "pic" alt = "1x1" width = "120" height = "120">
				@else
					<img src = <?php echo 'wallet//'.$user->sn_year.$user->sn_num.'/thumbnail.png'?> id = "pic" alt = "1x1" width = "120" height = "120">
				@endif
				<span class="info"><a href="{{ url('/ViewEmergency1') }}"><i class="fa fa-btn fa-info-circle"></i></a></span>
			</div>
			<a href="/MakePass"><button class="btn btn-primary" id = "dl">Download ID</button></a>
		</div>
		
    </body>
</html>
@endsection
