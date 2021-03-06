@extends('school.master')

@section('title')
@parent
:: Create School
@stop

@section('content')

<style>
    #pad{padding: 8px}
</style>

<h1>Edit {{ $school->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($school, array('route' => array('school.update', $school->id), 'method' => 'PUT')) }}

	<div id="pad" class="form-inline" class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control','autofocus')) }}
	</div>



	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop