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
			
            <form method="post" action="{{url('/AdminCampDept')}}">
				{!! csrf_field() !!}
				<div class="box">
				<?php
					if (session('success')){
						echo"<br><br><div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							".session('success')."
							</div>";
					}
					else if (session('fail')){
						echo"<br><br><div class='alert alert-danger'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							".session('fail')."
							</div>";
					}
				?>
					<label>Add Campus</label><br>
					<label>Campus Name: </label><input type = "text" name = "campus"></input><br><br>
					<button type = "submit" name = "action" value = "addCampus">Add Campus</button><br><br><br>
					<label>Add Department</label><br>
					<label>Campus: </label>
					<select name = "campusdept">
					@foreach ($campuses as $campus)
						<option value = '{{$campus->cname}}'>{{$campus->cname}}</option>
					@endforeach
					</select><br><br>
					<label>Department Name:</label><input type = "text" name = "dept"></input><br><br>
					<button type = "submit" name = "action" value = "addDept">Add Department</button>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection

