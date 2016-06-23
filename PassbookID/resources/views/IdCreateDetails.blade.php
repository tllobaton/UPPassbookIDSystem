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
			.outerbox {
				width: 100%;
				height: 100%;
			}
			.box {
				
				max-height: 700px;
				border-style:ridge;
				border-color: maroon;
				position: fixed;
				top: 50%;
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
			.header {
				font-size: 50px;
			}
		
			
        </style>
    </head>
    <body>
        <div class="container">
            <form method = "get" action = "{{url('/Contacts')}}">
				<div class ="outerbox">
					<div class="box">
						<label class = "header">Create ID</label><br>
							<label class = "inform">First Name:</label>
							<input class = "inform" type="text" required></input><br>
						
							<label class = "inform">Middle Initial:</label>
							<input class = "inform" type="text" required></input><br>
						
							<label class = "inform">Last Name:</label>
							<input class = "inform" type="text" required></input><br>
					
							<label class = "inform">Suffix Name:</label>
							<input class = "inform" type="text" placeholder="Leave blank if not applicable"></input><br>
										
							@if (Auth::user()->adminstatus == 'no')
								<label class = "inform">Student Number:</label>
							@else
								<label class = "inform">Employee ID:</label>
							@endif
							
							<input class = "inform" type="text" placeholder = "202011111" required></input><br>
							<label class = "inform">Campus Unit:</label>
							<select class = "inform">
							<option> ----------</option>
							<option> UP Baguio</option>
							<option> UP Cebu</option>
							<option> UP Diliman</option>
							<option> UP Los Baños</option>
							<option> UP Manila</option>
							<option> UP Mindanao</option>
							<option> UP Visayas</option>
							</select><br>
						
							@if (Auth::user()->adminstatus == 'no')
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