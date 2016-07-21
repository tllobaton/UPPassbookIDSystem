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
			#box {
				position: absolute;
				top: 475px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
				width: 100%;
			}
			.table-responsive{
				overflow-x: auto;
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
			}
			.header {
				font-size: 20px;
				margin-bottom: 20px;
			}
			.panel-heading{
				font-size: 16px;
			}
			.panel{
				width: 400px;
				margin-top: 30px;
				margin-left: 36%;
			}
			@media screen and (max-width: 768px){
				.panel{
					width: 100%;
					margin-top: 30px;
					margin-left: 0%;
				}
			}
			@media screen and (min-width: 768px){
				.panel{
					width: 80%;
					margin-top: 30px;
					margin-left: 11%;
				}
			}			
			@media screen and (min-width: 1020px){
				.panel{
					width: 60%;
					margin-top: 30px;
					margin-left: 21%;
				}
			}			
			@media screen and (min-width: 1920px){
				.panel{
					width: 40%;
					margin-top: 30px;
					margin-left: 31%;
				}
			}
			th{
				text-align: center;
			}
			.alert{
				width: 300px;
				transform: translate(-50%, -50%);
				margin-left: 50%;
			}
        </style>
    </head>
    <body>
        <div class="container" id="box">
			<label class = "header">Activate/Deactivate Users</label><br>
			<form method="get" action="{{url('/SearchUser1')}}">
				{!! csrf_field() !!}
				<input class = "inform" type = "text" id = "searchinput" name = "searchinput" placeholder = "Name or email address"  title = "Input UP Mail address or Name" required></input><br>
				<button class="btn btn-primary" type="submit">Search</button>
			</form>
			<div class="col-md-8 col-md-offset-2">
				@if(isset($results))
					@if(count($results) == 0)
						<br><br><div class="alert alert-danger">No results found.</div>
					@elseif(count($results) >= 1)
					<div class="panel panel-default search_display">
						<div class="panel-heading">List of Users</div>
						<div class="panel-body table-responsive">
							<table class="tbl table table-hover table-condensed text-center">
								<form method="post" action="{{url('/AdminActDeactUsers')}}">
								{!! csrf_field() !!}
									<tr>
										<th>Name</th>
										<th>Email address</th>
										<th>Account Status</th>
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
										@if($result->active=="yes")
											<td style="color: #00EE00">Active</td>
										@else
											<td style="color: #FF0000">Deactivated</td>
										@endif
										<td>
											<input type="checkbox" name="selected[]" id="{{ $result->name }}" value="{{ $result->name }}">
										</td>
									</tr>
									@endforeach
									<tr>
										<td colspan="3"><button class="btn btn-primary" name = "action" value = "activate" type="submit" onClick = "return confirm('Are you sure you want to enable the user account/s?')">Reactivate User/s</button></td>
									</tr>
									<tr>
										<td colspan="3"><button class="btn btn-primary" name = "action" value = "deactivate" type="submit" onClick = "return confirm('Are you sure you want to disable the user account/s?')">Deactivate User/s</button></td>
									</tr>
								</form>
							</table>
							{!! $results->appends(['searchinput' => Input::get('searchinput')])->render() !!}
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
			</div>
			<div class="flash-message">
				@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				  @if(Session::has('alert-' . $msg))
					<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					@endif
					@endforeach
			</div>
		</div>
    </body>
</html>
@endsection