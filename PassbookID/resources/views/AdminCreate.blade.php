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
				top: 450px;
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
			/*.flash-message{
				position: absolute;
				font-size: 48px;
				bottom: 0;
				left: 0;
			}*/
        </style>
    </head>
    <body>
        <div class="container">
			
            <form method="post" action="{{url('/PromoteUser')}}">
				{!! csrf_field() !!}
				<div class="box">
					<label class = "header">Promote to Admin</label><br>
					<input onclick="document.getElementById('email').disabled = false; document.getElementById('username').disabled = true; document.getElementById('idnum').disabled = true; document.getElementById('username').value=''; document.getElementById('idnum').value='';" type="radio" name="type"><label class="inform">Search by user email:</label><br>
					<input disabled="disabled" class = "inform" type = "text" id = "email" name = "email" placeholder = "fmlast@up.edu.ph" pattern = "[a-z0-9._%+-]+@up.edu.ph" title = "Enter the UP Mail address"></input><br><br>
					<hr>
					<input onclick="document.getElementById('username').disabled = false; document.getElementById('email').disabled = true; document.getElementById('idnum').disabled = true; document.getElementById('email').value=''; document.getElementById('idnum').value='';" type="radio" name="type"><label class="inform">Search by Name:</label><br>
					<input disabled="disabled" class = "inform" type = "text" id = "username" name = "username" placeholder = "Enter Full Name"></input><br><br>
					<hr>
					<input onclick="document.getElementById('idnum').disabled = false; document.getElementById('username').disabled = true; document.getElementById('email').disabled = true; document.getElementById('username').value=''; document.getElementById('email').value='';" type="radio" name="type"><label class="inform">Search by Student Number/Employee ID:</label><br>
					<input disabled="disabled" class = "inform" type = "text" id = "idnum" name = "idnum" placeholder = "2020-11111" pattern = "\d{4}[\-]\d{5}"></input><br><br>
					<hr>
					<button type="submit">Promote</button>
					<div class="flash-message">
						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
						  @if(Session::has('alert-' . $msg))
							<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							@endif
							@endforeach
					</div>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection