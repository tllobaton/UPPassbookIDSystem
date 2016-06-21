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
	img {
		width:70px;
		height:70px;
		margin-right: 5px;
	}

</style>
<div class = "container">
	<div class = "box">
		<h1>UP ID GENERATOR</h1>
		<a href="/redirect"><button><img src = "/img/UPLogo.png">Sign in with UP Mail</button></a>
	</div>
</div>
@endsection
