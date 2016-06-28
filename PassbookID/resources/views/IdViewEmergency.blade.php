@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			hr{
			  border-style: solid none;
			  border-width: 1px 0;
			  margin: 3px 0;
			}
			.card {
				position:absolute;
				vertical-align: middle;
				horizontal-align: middle;
				border: .5px;
				border-radius: 10px;
				border-style:solid;
				height: 205px;
				width: 326px;
				transform: translate(-50%, -50%);
				top: 250px;
				left: 50%;
			}
			.header{
				font-size: 16px;
				margin-left: 5%;
				margin-top: 4%;
			}
			.txt{
				font-size: 12px;
				margin-left: 5%;
			}
			.info{
				font-size: 12px;
				margin-left: 5%;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<label class="header"><a href="{{ url('/ViewId') }}"><i class="fa fa-btn fa-arrow-left"></i></a>Person to contact in case of emergency</label><hr>
				<label class="txt">Name: </label><label class="txt"><?php echo $user->ename?></label><br>
				<label class="txt">Contact Number: </label><label class="txt">{{$user->enum}}</label><br>
				<label class="txt">Address: </label><label class="txt" style="font-size: 10px;"><?php echo $user->eaddress?></label><br>
			</div>
		</div>
    </body>
</html>
@endsection
