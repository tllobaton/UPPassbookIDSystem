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
				top: 250px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
			}
			
			.inform, button {
				margin: 10px;		
			}
			label.inform {
				width: 150px;
			}
			input.inform {
				width: 200px;
				padding: 5px;
				margin:0px;
			}
			.header {
				font-size: 20px;
				margin-bottom: 20px;
			}
			.search_display{
				position: absolute;
				top: 275px;
				left: 50%;
				transform: translate(-50%, -50%);
				text-align: center;
				width: 150%;	
			}
			.panel-heading{
				font-size: 16px;
			}
			th{
				text-align: center;
			}
			/*.flash-message{
				position: absolute;
				font-size: 48px;
				bottom: 0;
				left: 0;
			}*/
        </style>
    </head>
    <body>
        <div class="container">
			<div class="box">
				<label class = "header">Promote to Admin</label><br>
				<form method="post" action="{{url('/SearchUser')}}">
					{!! csrf_field() !!}
					<input class = "inform" type = "text" id = "searchinput" name = "searchinput" placeholder = "Name or email address"  title = "Input UP Mail address or Name" required></input><br>
					<button class="btn btn-primary" type="submit">Search</button>
				</form>
				@if(isset($results))
					@if(count($results) == 0)
						<br><br><div class="alert alert-danger">No results found.</div>
					@elseif(count($results) >= 1)
					<div class="panel panel-default search_display">
						<div class="panel-heading">User List</div>
						<div class="panel-body table-responsive">
							<table class="tbl table table-hover table-condensed text-center">
								<form method="post" action="{{url('/PromoteUser')}}">
								{!! csrf_field() !!}
									<tr>
										<th>Name</th>
										<th>Email address</th>
										<td></td>
									</tr>
									@foreach($results as $result)
									<tr>
										<td>
											{{ $result->name }}
										</td>
										<td>
											{{ $result->email }}
										</td>
										<td>
											<input type="checkbox" name="promote[]" id="{{ $result->name }}" value="{{ $result->name }}">
										</td>
									</tr>
									@endforeach
									<tr>
										<td colspan="3"><button class="btn btn-primary" type="submit">Promote Selected Users</button></td>
									</tr>
								</form>
							</table>
						</div>
					</div>
					@endif 
				@endif
				@if(isset($message))
					<br><br><div class="alert alert-danger">{{ $message }}</div>
				@endif
				@if(isset($msg))
					<br><br><div class="alert alert-success">{{ $msg }}</div>
				@endif
				<div class="flash-message">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
					  @if(Session::has('alert-' . $msg))
						<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
						@endif
						@endforeach
				</div>
			</div>
		</div>
<!--            <form method="post" action="{{url('/PromoteUser')}}">
				{!! csrf_field() !!}
				<div class="box">
					<>
				</div>
			</form>
		</div>-->
    </body>
</html>
@endsection