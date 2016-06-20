@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Create ID</title>
        <style>
			.box {
				border-style:solid;
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
			}
			
			form {
				display: table;
			}
			
			table {
				border-collapse: separate;
				border-spacing: 0 1em;
			}
			t {
				padding-bottom: 5px;
				padding-top: 5px;
				display: table-row
			}
			.intable {
				display: table-cell;
			}
			input {
				margin-left: 5px;
			}
			.space {
				height:10px;
			}
			
			label,input {
				margin-top:5px;
			}
			
			.header {
				font-size: 50px;
				margin-bottom: 10px;
			}
        </style>
    </head>
    <body>
        <div class="container">
            <form>
				
				<div class="box">
					<label class = "header">Create ID</label>
					<t>
						<label class = "intable">Full Name:</label>
						<input class = "intable"type="text" placeholder="example@up.edu.ph"></input><br><br>
					</t>
					<t>
						<label class = "intable">Student Number/Employee ID:</label>
						<input class = "intable" type="text"></input><br><br>
					</t>
					<t>
						<label class = "intable">Office/Department/College:</label>
						<input class = "intable" type="text"></input><br><br>
					</t>
					<t>
						<label class = "intable">Campus Unit:</label>
						<select class = "intable">
						<option> UP Baguio</option>
						</select><br><br>
					</t>
					<t>
						<label class = "intable">Photo:</label>
						<button class = "intable">Upload Photo</button><br><br>
					</t>
						<button type="submit">Create ID</button>

				</div>
			</form>
        </div>
    </body>
</html>
@endsection