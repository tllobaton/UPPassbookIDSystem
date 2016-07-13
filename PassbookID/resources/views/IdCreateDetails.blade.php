@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
	<script type = "text/javascript">
		function ConfigureDepts(campus, dept) {			
			var depts = <?php echo json_encode($array); ?>;
			dept.options.length = 0;
			for (i = 0; i < depts[campus.value].length; i++) {
				createOption(dept, depts[campus.value][i].dname, depts[campus.value][i].dname)
			}	
		}
		
		function createOption(dept, text, value) {
			var opt = document.createElement('option');
			opt.value = value;
			opt.text = text;
			dept.options.add(opt);
		}
		
		function CampusDeptLoad(campus, dept, db_dept) {
			ConfigureDepts(campus, dept);
			dept.value = db_dept;
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
			#sn_year, #sn_num {
				width: 100px;
			}
			
        </style>
    </head>
    <body onload="CampusDeptLoad(document.getElementById('campus') ,document.getElementById('dept'), document.getElementById('chosendept').value )">
	
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
							<label class = "header">
							@if($user->createdsid=='no')
								Create
							@else
								Edit
							@endif
							<input class = "idtype" type = "text" name = "type" value = "student" size ="5" readonly></input> ID</label><br>
						@else
							<label class = "header">
							@if($user->createdeid=='no')
								Create
							@else
								Edit
							@endif
							<input class = "idtype" type = "text" name = "type" value = "employee" size ="7" readonly></input> ID</label><br>
						@endif
						
							<label class = "inform">First Name:</label>
							<input class = "inform" type="text" name = "fname" value = <?php echo '"'.$user->fname.'"'?> required pattern="^[A-Za-z\-Ññ'\s](?!.*?[\'-]{2})[A-Za-z\-Ññ\'\s]+"></input><br>
						
							<label class = "inform">Middle Initial:</label>
							<input class = "inform" type="text" name = "mname" pattern="^[A-Za-zÑñ]" value = {{$user->mname}}></input><br>
						
							<label class = "inform">Last Name:</label>
							<input class = "inform" type="text" name = "lname" value = <?php echo '"'.$user->lname.'"'?> required  pattern="^[A-Za-z\-Ññ'\s](?!.*?[\'-]{2})[A-Za-z\-Ññ\'\s]+"></input><br>
					
							<label class = "inform">Suffix Name:</label>
							<input class = "inform" type="text" name = "sname" placeholder="Jr., Sr., III, etc." value = {{$user->sname}}></input><br>
										
							@if ($type == 'student')
								<label class = "inform">Student Number:</label>
								<input class = "inform" id = "sn_year" name = "sn_year" type = "text" placeholder = "2013" pattern = "\d{4}"  title = "4 digit year" required value = {{$user->sn_year}}></input><input class = "inform" id = "sn_num" name = "sn_num" type = "text" placeholder = "65734" pattern = "\d{5}" title = "5 digit number" required value = {{$user->sn_num}}><br>
							@else
								<label class = "inform">Employee ID:</label>
								<input class = "inform" name = "empnum" type="text" placeholder = "202011111" pattern = "\d{9}" title = "Enter your student number" required value = {{$user->empnum}}></input><br>
							@endif
							
							<label class = "inform">Photo:<input class = "inform" name = "photo" type="file" accept="image/*" size = "800" required></label><br>
							
							<input type = "text" id = "chosendept" value = '{{$user->dept}}' hidden readonly></input>
							<label class = "inform">Campus Unit:</label>
			
							<select required class = "inform" id = "campus" name = "campus" onchange="ConfigureDepts(this ,document.getElementById('dept'))">
							<option value = "none">Select campus</option>
							@foreach ($campuses as $campus)
								@if ($campus->cname == $user->campus)
									<option selected value = '{{$campus->cname}}'> {{$campus->cname}}</option>
								@else
									<option value = '{{$campus->cname}}'> {{$campus->cname}}</option>
								@endif
							@endforeach
							</select><br>
			
							@if ($type == 'student')
								<label class = "inform">Department/College: </label>
							@else
								<label class = "inform">Office: </label>
							@endif
							
							<select required class = "inform" name = "dept" id = "dept">
							<option>Select a campus</option>
							</select><br>
						
						<button type="submit">Next page</button>
					</div>
				</div>
			</form>
			
        </div>
    </body>
</html>

@endsection