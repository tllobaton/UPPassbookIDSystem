@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			.hr1{
				border-style: solid none;
				border-width: 1px 0;
				margin: 3px 0;
				width: 90%;
				margin-left: 18px;
				margin-bottom: 8px;
			}
			hr{
				border-width: 1px 0;
				width: 90%;
				margin: 3px 0;
				margin-left: 18px;
			}
			.card {
				position:absolute;
				vertical-align: middle;
				horizontal-align: middle;
				border: .5px;
				border-radius: 10px;
				border-style:solid;
				height: 265px;
				width: 402px;
				transform: translate(-50%, -50%);
				top: 340px;
				left: 50%;
			}
			.header{
				font-size: 18px;
				margin-left: 7%;
				margin-top: 2%;
				color: #800000;
			}
			.txt{
				font-size: 14px;
				margin-left: 5%;
			}
			.txtdetails{
				font-size: 12px;
				margin-left: 2%;
				font-style: italic;
			}
			.fa-arrow-left{
				font-size: 1.75em;
			}
        </style>
    </head>
    <body>
		<div class = "container">
			<div class = "card">
				<label class="header">
				@if($type=='employee')
					<a href="{{ url('/ViewId/employee') }}"><i class="fa fa-btn fa-arrow-left"></i></a>
						Employee Details
					</label><hr class="hr1">
					<label class="txt">GSIS No: </label><label class="txtdetails">{{$user->gsis}}</label>
					<label class="txt">TIN: </label><label class="txtdetails">{{$user->tin}}</label><br><hr>
					<label class="txt">Blood Type: </label><label class="txtdetails">{{$user->blood}}</label>
					<label class="txt">Employment Status: </label><label class="txtdetails">{{$user->empstatus}}</label><br><hr>
					<label class="txt">Contact in case of emergency: </label><label class="txtdetails">{{$user->ename}}</label><br><hr>
				@else
					<a href="{{ url('/ViewId/student') }}"><i class="fa fa-btn fa-arrow-left"></i></a>
						Person to contact in case of emergency
					</label><hr class="hr1">
					<label class="txt">Name: </label><label class="txtdetails">{{$user->ename}}</label><br><hr>
				@endif
				<label class="txt">Contact Number: </label><label class="txtdetails">{{$user->enum}}</label><br><hr>
				<label class="txt">Address: </label><div class="txtdetails" style="margin-left: 20px;">{{$user->eaddress}}</div>
			</div>
		</div>
    </body>
</html>
@endsection
