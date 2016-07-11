@extends('layouts.app')

@section('content')
<html>
	<head>
		<title>Administrator</title>
		<style>
			#content{
				position: absolute;
				top: 0;
				margin-top: 375px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="container" id="content">
			<h1>List of Users</h1>
			<a href="/AdminViewStud"><button class="btn btn-primary">Students</button></a>
			<a href="/AdminViewEmp"><button class="btn btn-primary">Employees</button></a><hr>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						@if(isset($s_users))
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Students</h3></div>
								<div class="panel-body table-responsive">
									<table class="tbl table table-hover table-condensed text-center">
										 <tr>
											<th class="text-center">Student Number</th>
											<th class="text-center">Name</th>
											<th class="text-center">Account Status</th>
										 </tr>
										 @foreach($s_users as $s_user)
											@if($s_user->isenrolled=="yes")
											 <tr>
												<td>{{ $s_user->sn_year }}-{{$s_user->sn_num}}</td>
												<td>{{ $s_user->name }}</td>
												@if($s_user->active=="yes")
													<td style="color: #00EE00">Active</td>
												@else
													<td style="color: #FF0000">Deactivated</td>
												@endif
											 </tr>
											@endif
										 @endforeach
									</table>
								</div>
							</div>
						{!! $s_users->render() !!}
						@endif
						@if(!empty($e_users))
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Employees</h3></div>
								<div class="panel-body table-responsive">
									<table class="tbl table table-hover table-condensed text-center">
										<tr>
											<th class="text-center">Employee ID</th>
											<th class="text-center">Name</th>
											<th class="text-center">Account Status</th>
										</tr>
										@foreach($e_users as $e_user)
											@if($e_user->isemployed=="yes")
											<tr>
												<td>{{ $e_user->empnum }}</td>
												<td>{{ $e_user->name }}</td>
												@if($e_user->active=="yes")
													<td style="color: #00EE00">Active</td>
												@else
													<td style="color: #FF0000">Deactivated</td>
												@endif
											</tr>
											@endif
										@endforeach
									</table>
								</div>
							</div>
						{!! $e_users->render() !!}
						@endif
					</div>
				</div>
		</div>
	</body>
</html>
@endsection