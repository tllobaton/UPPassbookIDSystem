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
		<a href="/Details/student"><button>Create ID as student</button></a>
		<a href="/Details/employee"><button>Create ID as employee</button></a>
		@if (Auth::user()->adminstatus == 'yes')
			<a href="/AdminView"><button>Switch to admin view</button></a>
		@endif
	</div>
</div>
@endsection