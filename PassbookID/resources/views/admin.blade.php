@extends('layouts.app')

@section('content')
<html>
	<head>
		<title>Administrator</title>
		<style>
			#content{
				margin-top: 15%;
			}
		</style>
	</head>
	<body>
		<div class="container" id="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">List of Users</div>
						<div class="panel-body table-responsive">
							<table class="table table-hover table-condensed text-center">
								 <tr>
									<th class="text-center">Student Number</th>
									<th class="text-center">Name</th>
									<th class="text-center">Employee ID</th>
									<th class="text-center">Name</th>
								 </tr>
								 @foreach($users as $user)
								 <tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->id }}</td>
									<td>{{ $user->name }}</td>
								 </tr>
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