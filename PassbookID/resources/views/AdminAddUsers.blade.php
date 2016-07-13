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
		
		input {
			align: center;
			margin-left: 300px;
			margin-right: 200px;
		}
		</style>
	</head>
	<body>
        <div class="container">
            <form method="post" action="{{url('/AdminAddUsers')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="box">
					<?php
					if (session('success')){
						echo"<br><br><div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							".session('success')."
							</div>";
					}
					
					else if(session('fail')){
						echo"<br><br><div class='alert alert-danger'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							".session('fail')."
							</div>";
					}
					?>
					<label>Add Users</label><br><br>
					<label>Select CSV file. </br>File format must be: email,lastname,firstname,middleinitial,isenrolled,isemployed</br>In case of error, program adds all users to the database up to the line of error</label><br><br>
					<input type = "file" name = "filetoopen" required><br>
					<button type = "submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection

