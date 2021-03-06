@extends('countryOrigin.master')

@section('title')
@parent
:: Create Country of Origin
@stop

@section('content')

<style>
    #pad{padding: 8px}
</style>

<h1>Edit a Country of Origin</h1>

{{ HTML::ul($errors->all()) }}

{{ Form::model($countryOrigin, array('route' => array('countryOrigin.update', $countryOrigin->id), 'method' => 'PUT')) }}

        <div id="pad" class="form-inline" class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control','autofocus')) }}
	</div>


	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop