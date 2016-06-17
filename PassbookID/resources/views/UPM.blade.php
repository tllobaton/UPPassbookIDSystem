@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			.card {
				position:absolute;
				border: .5px;
				border-radius: 10px;
				border-style:solid;
				height: 205px;
				width: 326px;
			}
			.upper {
				position:absolute;
				text-align: right;
				height: 92.5px;
				width:325px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}
			.lower {
				position:absolute;
				height: 112.5px;
				width:325px;
				top: 92.5px;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}
			.campus {
				position:absolute;
				left: 0px;
				margin-left:28%;
				text-align: left;
				font-family: "Times New Roman";
			}
			#UP {
				position:absolute;
				margin-top:5px;
				color: #800000;
				font-size: 14px;
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
			}
			.details{
				position:absolute;
				left:0px;
				top: 0px;
				margin-left:50px;
				margin-top: 5px;
				text-align: center;
			}
			#pic {
				position:absolute;
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
					<img src = "/img/UPMLogo.png" id = "logo" alt = "logo" width = "70" height = "70">
					<label class = "campus" id = "UP">University of the Philippines Manila</label><br><label style="margin-right: 12%"><em>The Health Sciences Center</em></label><br>
				</div>
				<div class = "lower">
					<div class = "details">
						<label>TAYLOR A. SWIFT</label><br>
						<label>2007-01230</label><br/>
						<label>COLLEGE OF MUSIC</label>
					</div>
				</div>
				<img src = "/img/sample.png" id = "pic" alt = "1x1" width = "120" height = "120">
			</div>
		</div>
		
    </body>
</html>
@endsection
