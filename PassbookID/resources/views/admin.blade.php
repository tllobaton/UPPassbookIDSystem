@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of Users</div>
                <div class="panel-body table-responsive">
					<table class="table table-hover table-condensed text-center">
						 <tr>
							<th class="text-center">Student Number/Employee ID</th>
							<th class="text-center">Name</th>
						 </tr>
						 @foreach($users as $user)
						 <tr>
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
@endsection