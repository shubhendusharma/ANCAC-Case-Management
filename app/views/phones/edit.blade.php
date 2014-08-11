@extends('phones.master')

@section('title')
@parent
:: Edit Phone
@stop

@section('content')

<h1>Edit Phones</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($phones, array('route' => array('phones.update', $phones->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('number', 'Number') }}
		{{ Form::text('number', Input::old('number'), array('class' => 'form-control')) }}
	</div>
        <div class="form-group">
		{{ Form::label('type', 'Type') }}
		{{ Form::select('type', array('0' => 'Select a Phones', '1' => 'Home',
                            '2' => 'Work', '3' => 'Cell'), 
                    Input::old('type'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the Phones!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>