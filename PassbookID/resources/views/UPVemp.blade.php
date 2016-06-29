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
				height: 326px;
				width: 225px;
			}
			.upper {
				position:inherit;
				text-align: right;
				height: 163px;
				width: 225px;
				border: solid 1px red;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}
			.lower {
				position:inherit;
				height:163px;
				width:225px;
				top: 163px;
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
				top: 50px;
				left: 5px;
				margin-top:7px;
				text-align: center;
				font-size: 8px;
			}
			
			#UP2 {
				position:inherit;
				top: 60px;
				left: 5px;
				margin-top:7px;
				text-align: center;
				font-size: 9px;
			}
			
			#CU {
				position:inherit;
				margin-top:-20px;
			}
			#logo1 {
				position:inherit;
				left: 50px;
				margin-top:5px;
				margin-left:5px;
			}
			.details{
				position:inherit;
				left:0px;
				top: 20px;
				margin-left:20px;
				margin-top: 5px;
				text-align: center;
				color: white;
				
			}
			#pic {
				position:inherit;
				right: 0px;
				top: 85px;
				left: 65px;
				border: 2px solid #800000;
				margin-right: 5px;
				margin-bottom: 5px;
				z-index: 10;
			}
			
			.ident {
				font-size: 7px;
			}
			
			.detail {
				font-size: 9px;
			}
        </style>
    </head>
    <body>
		<div class = "container">
		
			<div class = "card">
			<img src = "/img/sample.png" id = "pic" alt = "1x1" width = "100" height = "100">
				<div class = "upper">
					<img src = "/img/UPLogo.png" id = "logo1" alt = "logo" width = "50" height = "50">
					<label class = "campus" id = "UP">UNIVERSITY OF THE PHILIPPINES SYSTEM</label><br>
					<label class = "campus" id = "UP2">UNIVERSITY OF THE PHILIPPINES VISAYAS</label>
				</div>
				
				<div class = "lower">
					<div class = "details">
						<label class = "ident">EMPLOYEE NO.</label><br>
						<label class = "detail">{{$user->idnum}}</label><br>
						<label class = "ident">NAME</label><br>
						<label class = "detail">{{$user->fname}} {{$user->mname}}. {{$user->lname}} <?php if($user->sname != null) echo $user->sname?></label><br>
						<label class = "ident">UNIT/COLLEGE</label><br>
						<label class = "detail">{{$user->dept}}</label>
					</div>			
				</div>
			</div>
		</div>
		
    </body>
</html>
@endsection
