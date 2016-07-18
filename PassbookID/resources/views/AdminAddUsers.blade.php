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
			width: 100%;
			position: absolute;
			top: 300px;
			left: 50%;
			transform: translate(-50%, -50%);
			padding:20px;
			text-align: center;
		}
		
		input {
			position: absolute;
			transform: translate(-50%, -50%);
			left: 53%;
			align: center;
		}
		.display{
			position: absolute;
			transform: translate(-50%, -50%);
			top: 50%;
			left: 50%;
			width: 80%;
		}
		</style>
	</head>
	<body>
        <div class="container">
            <form method="post" action="{{url('/AdminAddUsers')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				
				<div class="box">
					
					<div  class="display">
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
						<label style = "font-size: 20px; margin-top: 20px">Add Users</label><br><br>
						<label>Select CSV file. </br>File format must be: email,lastname,firstname,middleinitial(no period),suffixname(no period),isnerolled (yes/no),isemployed(yes/no)</br>Leave as blank if user does not have column</br>In case of error, program adds all users to the database up to the line of error</label><br><br>
						<input type = "file" name = "filetoopen" required><br>
						<button type = "submit" class="btn btn-primary" style="margin-top: 1%;">Upload</button>
					</div>
				</div>
			</form>
		</div>
    </body>
</html>
@endsection

