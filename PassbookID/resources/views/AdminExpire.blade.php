@extends('layouts.app')

@section('content')
<html>
	<head>
		<style>
		* {
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		  
		}
		
		.box {
			position: absolute;
			top: 400px;
			left: 50%;
			transform: translate(-50%, -50%);
			padding:20px;
			text-align: center;
		}
		</style>
	</head>
	<body>
        <div class="container">
            <form method="post" action="{{url('/AdminExpire')}}">
				{!! csrf_field() !!}
				<div class="box">
					<label>Set ID expire date</label><br>
					<label>Campus: </label>
					<select required>
					@foreach ($campuses as $campus)
						<option>{{$campus->cname}}</option>
					@endforeach
					</select><br><br>
					<label>Expiration Date: </label>
					<input type = "date"></input><br><br>
					<button type = "submit">Set</button>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection

