@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>UP Visayas</title>
        <style>
			hr{
			  border-style: solid none;
			  border-width: 1px 0;
			  margin:  0;
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
			#barcode{
				position: absolute;
				bottom: 0px;
				margin-bottom: 5px;
				margin-left: 20%;
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
				<label class="header"><a href="{{ url('/UPV') }}"><i class="fa fa-btn fa-arrow-left"></i></a>Person to contact in case of emergency</label><hr>
				<label class="txt">Name: </label><label class="txt">Dr. Meow Cat</label><br>
				<label class="txt">Contact Number: </label><label class="txt">09171784234</label><br>
				<label class="txt">Address: </label><label class="txt" style="font-size: 10px;">Test Unit, Test Building, Test Street, Test Barangay, Test City, Cat CountryTest Unit, Test Building, Test Street, Test Barangay, Test City, Cat Country</label><br>
				<div>
					<img src="barcode/img/2007-01230" id="barcode" alt="barcode">
				</div>
			</div>
		</div>
    </body>
</html>
@endsection
