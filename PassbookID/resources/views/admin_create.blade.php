@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Create ID</title>
        <style>
			body{text-align:center}
			
			.box {
				border-style:solid;
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
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
        </style>
    </head>
    <body>
        <div class="container">
			<h1>Promote to Admin</h1>
            <form>
				<div class="box">
					<t>
						<label class = "intable">User Email:</label>
						<select class = "intable">
						<option> tllobaton@up.edu.ph</option>
						<option> aadumon@up.edu.ph</option>
						</select><br><br>
					</t>
						<button type="submit">Promote</button>

				</div>
			</form>
        </div>
    </body>
</html>
@endsection