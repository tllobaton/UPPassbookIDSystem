@extends('layouts.app')

@section('content')
<html>
	<head>
		<title>Administrator</title>
		<style>
			#content{
				position: absolute;
				top: 300px;
				left: 50%;
				transform: translate(-50%, -50%);
				padding:20px;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="container" id="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">List of Students</div>
						<div class="panel-body table-responsive">
							<table class="tbl table table-hover table-condensed text-center">
								 <tr>
									<th class="text-center">Student Number</th>
									<th class="text-center">Name</th>
								 </tr>
								 @foreach($users as $user)
									@if($user->createstatusemp=="no")
									 <tr>
										<td>{{ $user->idnum }}</td>
										<td>{{ $user->fname . " " . $user->mname . " " . $user->lname }}</td>
									 </tr>
									@endif
								 @endforeach
							</table>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">List of Employees</div>
						<div class="panel-body table-responsive">
							<table class="tbl table table-hover table-condensed text-center">
								<tr>
									<th class="text-center">Employee ID</th>
									<th class="text-center">Name</th>
								</tr>
								@foreach($users as $user)
									@if($user->createstatusemp=="yes")
									<tr>
										<td>{{ $user->idnum }}</td>
										<td>{{ $user->fname . " " . $user->mname . " " . $user->lname }}</td>
									</tr>
									@endif
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
@endsection