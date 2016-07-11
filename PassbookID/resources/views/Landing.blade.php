@extends('layouts.app')

@section('content')
<style>
	.box {
		position:absolute;
		vertical-align: middle;
		horizontal-align: middle;
		text-align: center;
		transform: translate(-50%, -50%);
		left: 50%;
		top: 375px;
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

	<?php
		if (isset($pass)) {
			return $pass;
		}
	?>
	<div class = "box">	
		<h1>Welcome!</h1>
		
		@if (Auth::user()->isenrolled == 'yes' && Auth::user()->createdsid == 'no')
			<a href="/Details/student"><button class="btn btn-primary">Create Student ID</button></a>
		@elseif(Auth::user()->isenrolled == 'yes' && Auth::user()->createdsid == 'yes')
			<a href="/Details/student"><button class="btn btn-primary">Edit Student ID</button></a>
		@endif
		@if (Auth::user()->isemployed == 'yes' && Auth::user()->createdeid == 'no')
			<a href="/Details/employee"><button class="btn btn-primary">Create Employee ID</button></a>
		@elseif(Auth::user()->isemployed == 'yes' && Auth::user()->createdeid == 'yes')
			<a href="/Details/employee"><button class="btn btn-primary">Edit Employee ID</button></a>
		@endif
			<a href="/MakePass2"><button class="btn btn-primary">TEST MAKE PASS</button></a>
			<a href="/RemovePass"><button class="btn btn-primary">TEST REMOVE PASS</button></a>
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
				<td>{{$campus->studentuse}} <?php if($campus->totalstudents != 0) { echo "(".$campus->studentuse*100/$campus->totalstudents."%)";}?></td>
				<td>{{$campus->totalstudents}}</td>
				<td>{{$campus->empuse}} <?php if($campus->totalemps != 0) { echo "(".$campus->empuse*100/$campus->totalemps."%)";}?></td>
				<td>{{$campus->totalemps}}</td>
			</tr>
			@endforeach
	</div>
</div>
@endsection