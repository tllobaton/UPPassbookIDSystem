@extends('layouts.app')

@section('content')
<html>
	<script type = "text/javascript">
		function ConfigureDepts(campus, dept) {
			var diliman = ['College of Arts and Letters', 'College of Fine Arts', 'College of Human Kinetics', 'College of Mass Communication', 'College of Music', 'Asian Institute of Tourism', 'Virata School of Business', 'School of Economics', 'School of Labor and Industrial Relations', 'National College of Public Administration and Governance', 'School of Urban and Regional Planning', 'Technology Management Center', 'UPD Extension Program in Pampanga and Olongapo', 'Archaeological Studies Program', 'College of Architecture', 'College of Engineering', 'College of Home Economics', 'College of Science', 'School of Library and Information Studies', 'School of Statistics', 'Asian Center', 'College of Education', 'Institute of Islamic Studies', 'College of Law', 'College of Social Sciences and Philosophy', 'College of Social Work and Community Development'];
		
			switch (campus.value) {
				case 'Diliman':
					dept.options.length = 0;
					for (i = 0; i < diliman.length; i++) {
						createOption(dept, diliman[i], diliman[i]);
					}
			}
		}
		
		function createOption(dept, text, value) {
			var opt = document.createElement('option');
			opt.value = value;
			opt.text = text;
			dept.options.add(opt);
		}
	</script>
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
							<input class = "inform" type="text" name = "fname" value = <?php echo '"'.$user->fname.'"'?> required ></input><br>
						
							<label class = "inform">Middle Initial:</label>
							<input class = "inform" type="text" name = "mname" value = {{$user->mname}} required></input><br>
						
							<label class = "inform">Last Name:</label>
							<input class = "inform" type="text" name = "lname" value = <?php echo '"'.$user->lname.'"'?> required></input><br>
					
							<label class = "inform">Suffix Name:</label>
							<input class = "inform" type="text" name = "sname" placeholder="Jr., Sr., III, etc." value = {{$user->sname}} ></input><br>
										
							@if ($type == 'student')
								<label class = "inform">Student Number:</label>
							@else
								<label class = "inform">Employee ID:</label>
							@endif
							
							<input class = "inform" name = "id" type="text" placeholder = "202011111" value = {{$user->idnum}}  required></input><br>
							
							<label class = "inform">Photo:<input class = "inform" name = "photo" type="file" accept="image/*" size = "800"></label><br>
							
							
							<label class = "inform">Campus Unit:</label>
							<select class = "inform" id = "campus" name = "campus" onchange="ConfigureDepts(this,document.getElementById('dept'))">
							<option> ----------</option>
							<option value = "Baguio"> UP Baguio</option>
							<option value = "Cebu"> UP Cebu</option>
							<option value = "Diliman"> UP Diliman</option>
							<option value = "Los Baños"> UP Los Baños</option>
							<option value = "Manila"> UP Manila</option>
							<option value = "Mindanao"> UP Mindanao</option>
							<option value = "Open University"> UP Open University</option>
							<option value = "Visayas"> UP Visayas</option>
							</select><br>
			
							@if ($type == 'student')
								<label class = "inform">Department/College:</label>
							@else
								<label class = "inform">Office:</label>
							@endif
							
							<select class = "inform" name = "dept" id = "dept">
							</select><br>
					
						<button type="submit">Next page</button>
					</div>
				</div>
			</form>
        </div>
    </body>
</html>

@endsection