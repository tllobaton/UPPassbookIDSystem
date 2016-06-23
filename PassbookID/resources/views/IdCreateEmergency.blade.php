@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Create ID</title>
        <style>
			* {
			  -webkit-box-sizing: border-box;
			  -moz-box-sizing: border-box;
			  box-sizing: border-box;
			}
			.box {
				position: absolute;
				top: 500px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
			}
				
			.header {
				font-size: 20px;
				margin-bottom: 20px;
			}
			.inform, button {
				margin: 10px;	
				margin-bottom: 15px;
				font-size: 15px;
			}
			label.inform {
				width: 150px;
			}
			input.inform {
				width: 200px;
				padding: 5px;
				margin:0px;
			}
        </style>
    </head>
    <body>
        <div class="container">
            <form method = "post" action = {{url('/CreateId')}}>
				{!! csrf_field() !!}
				<div class="box">
					<label class = "header">Person to contact in case of emergency</label><br>
					<label class = "inform">Name:</label>
					<input class = "inform"type="text"></input><br><br>
					
					<label class = "inform">Contact number:</label>
					<input class = "inform" type="text"></input><br><br>
					
					<label class = "inform">Address:</label>
					<input class = "inform"type="text"></input><br><br>
					
					<button type="submit">Back</button>
					<button type="submit">Create ID</button>

				</div>
			</form>
        </div>
    </body>
</html>
@endsection