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
	.button {
		background-color: maroon;
		text-align: center;
		border-radius: 20px;
		color: white;
		margin-top: 10px;
		border: none;
		width: 225px;
		height: 50px;
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
		<a href="/redirect"><button class="btn button btn-primary"><h4>Sign in with UP Mail</h4></button></a>
		<?php
			if (session('xdomain')){
				echo"<br><br><div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('xdomain')."
					</div>";
			}
		?>
	</div>
</div>
@endsection
