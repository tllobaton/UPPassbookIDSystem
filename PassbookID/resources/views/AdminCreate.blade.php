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
				top: 250px;
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
					<label class = "inform">User Email:</label>
					<input class = "inform" type = "text" id="email" name="email"></input><br><br>
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