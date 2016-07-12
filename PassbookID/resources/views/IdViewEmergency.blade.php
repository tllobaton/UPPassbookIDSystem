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
				top: 50%;
				left: 50%;
			}
			.header{
				font-size: 18px;
				margin-left: 7%;
				margin-top: 4%;
				color: #800000;
			}
			.txt{
				font-size: 15px;
				margin-left: 5%;
			}
			.txtdetails{
				font-size: 14px;
				margin-left: 3%;
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
			<!-- GSIS No., Blood Type, TIN, Employment Status, Name, Contact Number, Address -->
				<label class="header"><a href="{{ url('/ViewId') }}"><i class="fa fa-btn fa-arrow-left"></i></a> 
				@if($user->isemployed=='yes')
						Employee Details
					</label><hr class="hr1">
					<label class="txt">GSIS No: </label><label class="txtdetails">{{$user->gsis}}</label>
					<label class="txt" style="margin-left: 12%;">Blood Type: </label><label class="txtdetails">{{$user->blood}}</label><br><hr>
					<label class="txt">TIN: </label><label class="txtdetails">{{$user->tin}}</label><br><hr>
					<label class="txt">Employment Status: </label><label class="txtdetails">{{$user->empstatus}}</label><br><hr>
					<label class="txt">Contact in case of emergency: </label><label class="txtdetails">{{$user->ename}}</label><br><hr>
				@else
						Person to contact in case of emergency
					</label><hr class="hr1">
				@endif
				<label class="txt">Name: </label><label class="txtdetails">{{$user->ename}}</label><br><hr>
				<label class="txt">Contact Number: </label><label class="txtdetails">{{$user->enum}}</label><br><hr>
				<label class="txt">Address: </label><label class="txtdetails">{{$user->eaddress}}</label><br>
			</div>
		</div>
    </body>
</html>
@endsection
