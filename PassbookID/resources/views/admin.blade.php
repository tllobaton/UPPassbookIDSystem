@extends('layouts.app')

@section('content')
<html>
	<head>
		<title>Administrator</title>
		<style>
			#content{
				position: absolute;
				top: 500px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
				width: 100%;
			}
			#searchfield{
				margin-top: 30px;
				margin-bottom: 25px;
			}
			.panel-heading{
				width: 100%;
			}
			.table-responsive{
				overflow-x: auto;
			}
			.panel{
				margin-top: 30px;
			}
			.form-group{
				width: 290px;
			}
			
			@media screen and (min-width: 1028px){
				table{
					table-layout: fixed;
				}
			}
			
		</style>
	</head>
	<body>
		<div class="container" id="content">
			<h2>List of Users</h2>
			<center>
			<form method="get" action="{{url('/Search_adminview')}}" id="searchfield">
				{!! csrf_field() !!}
				<div class="form-group has-feedback">
					<input class = "inform form-control" type = "text" id = "searchinput" name = "searchinput" placeholder = "Search user by name or email address"  title = "Input UP Mail address or Name" required></input>
					<span class="glyphicon glyphicon-search form-control-feedback">
					</span>
				</div>
			</form>
			</center>
			<a href="/AdminViewStud"><button class="btn btn-primary">Students</button></a>
			<a href="/AdminViewEmp"><button class="btn btn-primary">Employees</button></a>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					@if(isset($s_users))
						<div class="panel panel-default">
							<div class="panel-heading">Students</div>
							<div class="panel-body table-responsive">
								<table class="table table-hover table-condensed text-center">
									 <tr>
										<th class="text-center">Student Number</th>
										<th class="text-center">Name</th>
										<th class="text-center">Account Status</th>
									 </tr>
									 @foreach($s_users as $s_user)
										 <tr>
											<td>{{ $s_user->sn_year }}-{{$s_user->sn_num}}</td>
											<td style="text-align: left">{{ $s_user->lname }}, {{ $s_user->fname }} {{ $s_user->mname }}@if($s_user->mname!="").@endif  {{ $s_user->sname }}</td>
											@if($s_user->active=="yes")
												<td style="color: #00EE00">Active</td>
											@else
												<td style="color: #FF0000">Deactivated</td>
											@endif
										 </tr>
									 @endforeach
								</table>
							</div>
						</div>
					{!! $s_users->render() !!}
					@endif
					@if(isset($e_users))
						<div class="panel panel-default">
							<div class="panel-heading">Employees</div>
							<div class="panel-body table-responsive">
								<table class="tbl table table-hover table-condensed text-center">
									<tr>
										<th class="text-center">Employee ID</th>
										<th class="text-center">Name</th>
										<th class="text-center">Account Status</th>
									</tr>
									@foreach($e_users as $e_user)
										<tr>
											<td>{{ $e_user->empnum }}</td>
											<td style="text-align: left">{{ $e_user->lname }}, {{ $e_user->fname }} {{ $e_user->mname }}@if($e_user->mname!="").@endif  {{ $e_user->sname }}</td>
											@if($e_user->active=="yes")
												<td style="color: #00EE00">Active</td>
											@else
												<td style="color: #FF0000">Deactivated</td>
											@endif
										</tr>
									@endforeach
								</table>
							</div>
						</div>
					{!! $e_users->render() !!}
					@endif
					@if(isset($results))
						@if(count($results) == 0)
							<br><br><div class="alert alert-danger">No results found.</div>
						@elseif(count($results) >= 1)
							<div class="panel panel-default">
								<div class="panel-heading">User List Based on Keyword Searched</div>
								<div class="panel-body table-responsive">
									<table class="tbl table table-hover table-condensed text-center">
										<tr>
											<th class="text-center">Student Number/Employee ID</th>
											<th class="text-center">Name</th>
											<th class="text-center">Account Status</th>
										</tr>
										@foreach($results as $result)
											<tr>
												<td>@if($result->sn_year!=null && $result->sn_num!=null){{ $result->sn_year }}-{{ $result->sn_num }}@endif  @if($result->sn_year!=null && $result->empnum!=null)/@endif @if($result->empnum!=null){{ $result->empnum }}@endif</td>
												<td style="text-align: left">{{ $result->lname }}, {{ $result->fname }} {{ $result->mname }}@if($result->mname!="").@endif  {{ $result->sname }}</td>
												@if($result->active=="yes")
													<td style="color: #00EE00">Active</td>
												@else
													<td style="color: #FF0000">Deactivated</td>
												@endif
											</tr>
										@endforeach
									</table>
								</div>
							</div>
							{!! $results->appends(['searchinput' => Input::get('searchinput')])->render() !!}
						@endif
					@endif
				</div>
			</div>
		</div>
	</body>
</html>
@endsection