@extends('layouts.app')

@section('content')

	<body>
        <div class="container">
			
            <form method="post" action="{{url('/')}}">
				{!! csrf_field() !!}
				<div class="box">
					<label class = "header">Set ID expire date</label><br>
				</div>
			</form>
		</div>
    </body>
@endsectiondwda