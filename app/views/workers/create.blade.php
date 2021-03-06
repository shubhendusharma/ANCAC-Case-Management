@extends('workers.master')

@section('title')
@parent
:: Create Worker
@stop

@section('content')

<style>
    #pad{padding: 8px}
</style>
    
    <h1>Create a Worker</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'workers')) }}

	
<div class="form-inline">
	<div id="pad"  class="form-group">
		{{ Form::label('name', 'Name of the Worker') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control','autofocus')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('workerType_id', 'Worker Type') }}
		{{ Form::select('workerType_id', WorkerType::all()->lists('type','id'), Input::old('abuse_id'), array('class' => 'form-control')) }}
	</div>
</div>	


	{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop