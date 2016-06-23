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
            <form method = "post" action = "{{url('/Branch')}}" enctype="multipart/form-data">
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
						@if ($type == 'student')
							<label class = "header">Create <input class = "idtype" type = "text" name = "type" value = "student" size ="5" readonly></input> ID</label><br>
						@else
							<label class = "header">Create <input class = "idtype" type = "text" name = "type" value = "employee" size ="7" readonly></input> ID</label><br>
						@endif
						
							<label class = "inform">First Name:</label>
							<input class = "inform" type="text" required></input><br>
						
							<label class = "inform">Middle Initial:</label>
							<input class = "inform" type="text" required></input><br>
						
							<label class = "inform">Last Name:</label>
							<input class = "inform" type="text" required></input><br>
					
							<label class = "inform">Suffix Name:</label>
							<input class = "inform" type="text" placeholder="Leave blank if not applicable"></input><br>
										
							@if ($type == 'student')
								<label class = "inform">Student Number:</label>
							@else
								<label class = "inform">Employee ID:</label>
							@endif
							
							<input class = "inform" name = "id" type="text" placeholder = "202011111" required></input><br>
							
							<label class = "inform">Photo:<input class = "inform" name = "photo" type="file" accept="image/*" size = "800"></label><br>
							
							
							<label class = "inform">Campus Unit:</label>
							<select class = "inform">
							<option> ----------</option>
							<option> UP Baguio</option>
							<option> UP Cebu</option>
							<option> UP Diliman</option>
							<option> UP Los Baños</option>
							<option> UP Manila</option>
							<option> UP Mindanao</option>
							<option> UP Open University</option>
							<option> UP Visayas</option>
							</select><br>
						
							@if ($type == 'student')
								<label class = "inform">Department/College:</label>
							@else
								<label class = "inform">Office:</label>
							@endif
							
							<select class = "inform">
							<option> ----------</option>
							<option> College of Engineering</option>
							<option> College of Kagwapuhan</option>
							</select><br>
					
						<button type="submit">Next page</button>
					</div>
				</div>
			</form>
        </div>
    </body>
</html>
@endsection