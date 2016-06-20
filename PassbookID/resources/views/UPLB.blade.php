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
						<label>TAYLOR A. SWIFT</label><br>
						<label>2007-01230<br/>College of Music</label>
					</div>
					
				</div>
				<div class = "imgback">
					<img src = "/img/sample.png" id = "pic" alt = "1x1" width = "80" height = "120">
				</div>
			</div>
		</div>
		
    </body>
</html>
@endsection
