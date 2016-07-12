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
						<input class = "inform" type="text" name = "gsis" pattern = "\d{11}" title = "GSIS # is 11 digits" required value = {{$user->gsis}}></input><br>
					
						<label class = "inform">Blood Type:</label>
						<select class = "inform" name = "blood" value="none">
						@foreach ($bloodtype as $blood)
							@if ($blood == $user->blood)
								<option selected value = '{{$blood}}'> {{$blood}}</option>
							@else
								<option value = '{{$blood}}'> {{$blood}}</option>
							@endif
						@endforeach
						</select><br>
						<label class = "inform">TIN:</label>
						<input class = "inform" type="text" name = "tin" pattern = "\d{12}" title = "TIN # is 12 digits" required value = {{$user->tin}}></input><br>
					
						<label class = "inform">Employment Status:</label>
						<select class = "inform" name = "empstatus" value="none">
						@if ($user->empstatus == "permanent")
							<option selected value = "permanent"> Permanent </option>
							<option value = 'temporary'> Temporary</option>
						@elseif (($user->empstatus == "temporary"))
							<option value = "permanent"> Permanent </option>
							<option selected value = 'temporary'> Temporary</option>
						@else 
							<option value = "permanent"> Permanent </option>
							<option value = 'temporary'> Temporary</option>
						@endif
						</select><br>
					<button type="submit">Next page</button>
				</div>
			</form>
        </div>
    </body>
</html>
@endsection