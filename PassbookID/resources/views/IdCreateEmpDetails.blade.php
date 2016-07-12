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
			.inform, button{
				margin: 10px;
				margin-bottom: 15px;
				font-size: 15px;
			}
			label.inform {
				width: 150px;
			}
			input.inform, select {
				width: 200px;
				padding: 5px;
				margin:0px;
			}
			.header, .idtype{
				font-size: 30px;
			}
			.idtype {
				border: none;
			}
		
			
        </style>
    </head>
    <body>
        <div class="container">
            <form method = "post" action = "{{url('/Branch')}}">
				{!! csrf_field() !!}
				<div class="box">
					<label class = "header">
					@if($user->createdeid=='no')
						Create
					@else
						Edit
					@endif
					<input class = "idtype" type = "text" name = "type" value = "employeeL" size ="7" hidden readonly></input> ID</label><br>
						<label class = "inform">GSIS No.:</label>
						<input class = "inform" type="text" name = "gsis" required value = {{$user->gsis}}></input><br>
					
						<label class = "inform">Blood Type:</label>
						<select class = "inform" name = "blood" value="none">
						<option> ----------</option>
						<option> A</option>
						<option> B</option>
						<option> AB</option>
						<option> O</option>
						</select><br>
						<label class = "inform">TIN:</label>
						<input class = "inform" type="text" name = "tin" required value = {{$user->tin}}></input><br>
					
						<label class = "inform">Employment Status:</label>
						<input class = "inform" type="text" name = "empstatus" required value = {{$user->empstatus}}></input><br>
				
					<button type="submit">Next page</button>
				</div>
			</form>
        </div>
    </body>
</html>
@endsection