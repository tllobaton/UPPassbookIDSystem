@extends('layouts.app')

@section('content')
<!DOCTYPE html>
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
				top: 400px;
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
			#sn_year, #sn_num {
				width: 100px;
			}
			
        </style>
    </head>
    <body>
	
        <div class="container">
            <form method = "post" action = "{{url('/FirstLanding')}}">
				{!! csrf_field() !!}
				<div class ="outerbox">
					<div class="box">
						<?php
						if (session('xsize')){
							echo"<br><br><div class='alert alert-danger'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								".session('xsize')."
								</div>";
						}
						?>
						
							<label class = "inform">From what Campus Unit are you?:</label>
			
							<select required class = "inform" id = "campus" name = "campus">
							<option value = "none">Select campus</option>
							@foreach ($campuses as $campus)		
								<option value = '{{$campus->cname}}'> {{$campus->cname}}</option>					
							@endforeach
							</select><br>
						<button type="submit">Submit</button>
					</div>
				</div>
			</form>
			
        </div>
    </body>
</html>

@endsection