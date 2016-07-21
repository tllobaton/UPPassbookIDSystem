@extends('layouts.app')

@section('content')
<html>
<!DOCTYPE html>
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
			<div class="box">
				<form method = "post" action = {{url('/CreateId')}}>
					{!! csrf_field() !!}
					@if ($type == 'student') 
						<input class = "idtype" type = "text" name = "type" value = "student" size ="7" hidden readonly></input>
					@else 
						<input class = "idtype" type = "text" name = "type" value = "employee" size ="7" hidden readonly></input>
					@endif
					<label class = "header">Person to contact in case of emergency</label><br>
					<label class = "inform">Name:</label>
					<input class = "inform"type = "text" name = "ename" required pattern = "^[A-Za-z\-Ññ'](?!.*?[\'-\.]{2})[A-Za-z\-Ññ\'\.\s]+" value = <?php echo '"'.$user->ename.'"'?>></input><br><br>
					
					<label class = "inform">Contact number:</label>
					<input class = "inform" type = "text" name = "enum" required pattern = "\d{7}|\d{11}|\d{13}" value = {{$user->enum}}></input><br><br>
					
					<label class = "inform">Address:</label>
					<input class = "inform"type = "text" name = "eaddress" required pattern = "^[0-9A-Za-z,!@#&\-Ññ'](?!.*?[\,!@#&'-\.]{2})[0-9A-Za-z,!@#&\-Ññ\'\s\.]+" value = <?php echo '"'.$user->eaddress.'"'?>></input><br><br>
					<button class = "btn btn-primary" type="submit">Create ID</button>
				</form>
				@if ($type == 'student')
					<a href="/Details/student"><button type="submit" class = "btn btn-primary">Back</button></a>
				@else
					<a href="/EmpDetails"><button type="submit" class = "btn btn-primary">Back</button></a>
				@endif
			</div>
        </div>
    </body>
</html>
@endsection