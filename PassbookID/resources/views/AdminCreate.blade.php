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
			
			.inform, button {
				margin: 10px;		
			}
			label.inform {
				width: 150px;
			}
			input.inform {
				width: 200px;
				padding: 5px;
				margin:0px;
			}
			.header {
				font-size: 20px;
				margin-bottom: 20px;
			}
        </style>
    </head>
    <body>
        <div class="container">
			
            <form>
				<div class="box">
					<label class = "header">Promote to Admin</label><br>
					<label class = "inform">User Email:</label>
					<input class = "inform" type = "text"></input><br><br>
					<button type="submit">Promote</button>
				</div>
			</form>
        </div>
    </body>
</html>
@endsection