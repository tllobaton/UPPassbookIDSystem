@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Open University ID</title>
        <style>
			.card {
				position:absolute;
				border: .5px;
				transform: translate(-50%, -50%);
				top: 50%;
				left: 50%;
				border-radius: 10px;
				border-style:solid;
				height: 375px;
				width: 250px;
			}
			#CU {
				position: absolute;
				margin-top: 25%;
				margin-left: 2%;
				margin-right: 2%;
				height: 12%;
				left:0;
				right:0;
				background-color: #800000;
				color: #FFFFFF;
				text-align: center;
			}
			#pic_cont{
				position: absolute;
				margin-top: 45%;
				left: 0;
				margin-left: -4%;
				width: 50%;
				float: left;
			}
			#pic_cont2{
				position: absolute;
				margin-top: 45%;
				right: 0;
				margin-right: 4%;
				width: 50%;
				background-color: blue;
			}
			#pic {
				position:absolute;
				width: 100%;
				height: auto;
			}
			.logo{
				width: 75%;
				position:absolute;
				height: auto;
			}
			#logo2{
				margin-top: 50%;
				width: 100%;
				height: auto;
			}
			#name_cont{
				text-align: center;
				border: 1px solid #800000;
				position: absolute;
				margin-top: 100%;
				margin-left: 2%;
				margin-right: 2%;
				left:0;
				right:0;
			}
			#admin_id{
				color: #800000;
				text-align: center;
				position: absolute;
				margin-top: 110%;
				margin-left: 2%;
				margin-right: 2%;
				left:0;
				right:0;
			}
			#office{
				text-align: center;
				position: absolute;
				margin-top: 120%;
				margin-left: 2%;
				margin-right: 2%;
				left:0;
				right:0;
			}
			#admin_label{
				background-color:#4169E1;
				color: #FFFFFF;
				height: 6%;
				text-align: center;
				position: absolute;
				margin-top: 132%;
				margin-left: 2%;
				margin-right: 2%;
				left:0;
				right:0;
			}
        </style>
    </head>
    <body>
		<div class="container">
			<div class="card col-xs-12">
				<div id="CU" class="container-fluid">
					University of the Philippines<br>
					OPEN UNIVERSITY
				</div>
				<div class="container" id="pic_cont">
					<img src = "/img/sample.png" id="pic" alt = "admin picture">
				</div>
				<div class="container" id="pic_cont2">
					<img src = "/img/UPOULogo.jpg" class="logo" id="logo" alt = "UPOU Logo">
				</div>
				<div id="name_cont">
					<strong>TAYLOR A. SWIFT</strong>
				</div>
				<label id="admin_id"><strong>100000100</strong></label>
				<label id="office"><strong>Office of the University Registrar</strong></label>
				<label id="admin_label" style="">ADMINISTRATIVE</label>
			</div>
		</div>
	
	<!--
		<div class = "container">
			<div class = "card">
				<div class = "upper">
					<img src = "/img/UPOULogo.jpg" id = "logo" alt = "logo" width = "100" height = "70">
					<label class = "campus" id = "UP">University of the Philippines<br/><small>OPEN UNIVERSITY</small></label><br> height="250px" width="110px"
				</div>
				<div class = "lower">
					<div class = "details">
						<label style="margin-left: 15%;">TAYLOR A. SWIFT</label><br>
						<label style="font-size: 12px">Student#: </label>
						<label style="text-align: right">2007-01230</label><br/>
						<label style="margin-left: 2%; text-align: center;">COLLEGE OF MUSIC</label>
					</div>
				</div>
				<img src = "/img/sample.png" id = "pic" alt = "1x1" width = "120" height = "120">
			</div>
		</div>-->
		
    </body>
</html>
@endsection
