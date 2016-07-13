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
			top: 300px;
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
					<?php
					if (session('success')){
						echo"<br><br><div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							".session('success')."
							</div>";
					}
					?>
					<label style="font-size: 20px; margin-bottom: 20px">Set ID expire date</label><br>
					<label>Campus: </label>
					<select name = "campus" required>
					@foreach ($campuses as $campus)
						<option>{{$campus->cname}}</option>
					@endforeach
					</select><br><br>
					<label>Expiration Date: </label>
					<input type = "date" name = "expdate"></input><br><br>
					<button type = "submit" class="btn btn-primary">Set</button>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection

