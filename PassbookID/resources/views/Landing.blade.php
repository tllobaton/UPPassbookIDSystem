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


</style>
<div class = "container">
	<div class = "box">	
		<h1>Welcome!</h1>
		@if (Auth::user()->createstatusemp == 'yes')
			<a href="/Details/student"><button>Create Student ID</button></a>
			<a href="/Details/employee"><button>Create Employee ID</button></a>
		@else(Auth::user()->createstatusemp == 'no')
			<a href="/Details/student"><button>Create ID</button></a>
		@endif
	</div>
</div>
@endsection