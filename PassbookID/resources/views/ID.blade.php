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
				height: 265px;
				width: 402px;
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
				margin-left:23%;
				text-align: center;
				width: 100%;
				font-family: "Times New Roman";
			}
			#UP {
				position:inherit;
				margin-top:25px;
				color: #800000;
				font-size: 20px;
			}
			#CU {
				position:inherit;
				margin-top:-20px;
			}
			#logo {
				position:inherit;
				left: 8px;
				margin-top:5px;
			}
			.details{
				position:inherit;
				left:30px;
				top: 0px;
				margin-top: 0px;
				text-align: left;
				font-size: 16px;
			}
			#pic {
				position:inherit;
				right: 0px;
				bottom: 0px;
				border: 2px solid #800000;
				margin-right: 30px;
				margin-bottom: 30px;
			}
			#dl {
				position:absolute;
				bottom:0px;
				right: 0px;
			}
			.bcode {
				position: inherit;
				bottom: 0px;
				left: 20px;
				margin-bottom: 10px;
			}
			hr{
				position: absolute;
				top: 60px;
				left: 18px;
				width: 90%;
			}
			.fa-info-circle{
				font-size: 1.75em;
				position: absolute;
				right: 3px;
				bottom: 3px;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<div class = "upper">
					<img src = "/img/UPLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">University of the Philippines {{$user->campus}}</label>
				</div>
				<hr>
				<div class = "lower">
					<div class = "details">
						<label>{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label><br>
						<label style="font-size:26px">
							@if($user->isemployed=='yes')
								{{$user->empnum}}
							@else
								{{$user->sn_year}}-{{$user->sn_num}}
							@endif
						</label><br>
						<div style="font-size: 12px; width: 200px;"><label>{{$user->dept}}</label></div>
					</div>
				</div>
				@if($user->isemployed=='yes')
					<img src = <?php echo 'wallet//'.$user->empnum.'/thumbnail.png'?> id = "pic" alt = "1x1" width = "135" height = "135">
				@else
					<img src = <?php echo 'wallet//'.$user->sn_year.$user->sn_num.'/thumbnail.png'?> id = "pic" alt = "1x1" width = "135" height = "135">
				@endif
				<div class = "bcode">
					@if($user->isemployed=='yes')
						<img src=<?php echo "barcode/img/".$user->empnum?> alt="barcode">
					@else
						<img src=<?php echo "barcode/img/".$user->sn_year."-".$user->sn_num?> alt="barcode">
					@endif
				</div>
				<a href="{{ url('/ViewEmergency') }}"><i class="fa fa-btn fa-info-circle"></i></a>
			</div>
			<a href="/MakePass/{{$type}}"><button class="btn btn-primary" id = "dl">Download ID</button></a>
		</div>
		
    </body>
</html>
@endsection