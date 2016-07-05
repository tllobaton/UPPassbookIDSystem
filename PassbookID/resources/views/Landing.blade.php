@extends('layouts.app')

@section('content')
<style>
	.box {
		position:absolute;
		vertical-align: middle;
		horizontal-align: middle;
		text-align: center;
		transform: translate(-50%, -50%);
		top: 50%;
		left: 50%;
	}
	h1 {
		text-align: center;
		margin-bottom: 10px;
	}
	button {
		background-color: maroon;
		text-align: center;
		border-radius: 20px;
		color: white;
		margin-top: 10px;
	}
	table, th, td {
		border: 1px solid black;
	}
	
	th, td {
		text-align: center;
		width: 200px;
	}

</style>
<div class = "container">
	<div class = "box">	
		<h1>Welcome!</h1>
		
		@if (Auth::user()->isenrolled == 'yes' && Auth::user()->createdsid == 'no')
			<a href="/Details/student"><button>Create Student ID</button></a>
		@elseif(Auth::user()->isenrolled == 'yes' && Auth::user()->createdsid == 'yes')
			<a href="/Details/student"><button>Edit Student ID</button></a>
		@endif
		@if (Auth::user()->isemployed == 'yes' && Auth::user()->createdeid == 'no')
			<a href="/Details/employee"><button>Create Employee ID</button></a>
		@elseif(Auth::user()->isemployed == 'yes' && Auth::user()->createdeid == 'yes')
			<a href="/Details/employee"><button>Edit Employee ID</button></a>
		@endif
		<br><br>
		<table>
			<tr>
				<th>Campus</th>
				<th>Number of students using app</th>
				<th>Total number of students</th>
				<th>Number of employees using app</th>
				<th>Total number of employees</th>
			</tr>
			@foreach ($campuses as $campus)
			<tr>
				<td>{{$campus->cname}}</td>
				<td>{{$campus->studentuse}}</td>
				<td>{{$campus->totalstudents}}</td>
				<td>{{$campus->empuse}}</td>
				<td>{{$campus->totalemps}}</td>
			</tr>
			@endforeach
	</div>
</div>
@endsection