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
		width: 100%;
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
	.tbl{
		width: 100%;
	}
	
	th, td {
		text-align: center;
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
		<br><br>
		<div class="container">
			<div class="table-responsive">
				<table class="tbl table table-hover table-condensed">
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
					<tr>
						<td>People who haven't opened the app at all</td>
						<td>n/a</td>
						<td>{{$studentnull}}</td>
						<td>n/a</td>
						<td>{{$empnull}}</td>
					</tr>
			</div>
		</div>
	</div>
</div>
@endsection