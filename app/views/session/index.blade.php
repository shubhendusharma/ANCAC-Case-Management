@extends('session.master')

@section('title')
@parent
:: Session
@stop

@section('content')

<h1>All the Session</h1>
<a class="btn btn-small btn-success" href="..">Back to Dashboard</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
                        <td>Session Type</td>
			<td>Date</td>
                        <td>Time Start</td>
                        <td>Time End</td>
                        <td>Status</td>
			<td>Interviewer</td>
                        <td>Discussed Abuse</td>
		</tr>
	</thead>
	<tbody>
	@foreach($session as $key => $value)
		<tr>
                        <td>{{ $value->type->type }}</td>
			<td>{{ $value->date }}</td>
                        <td>{{ $value->timeStart }}</td>
                        <td>{{ $value->timeEnd }}</td>
                        <td>{{ $value->status }}</td>
			<td>{{ $value->primaryWorker->name }}</td>
                        <td>{{ $value->discussedAbuse }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the session (uses the destroy method DESTROY /session/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				{{ Form::open(array('url' => 'session/' . $value->id, 'class' => 'pull-left')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                        {{ Form::close() }}
				<!-- show the session (uses the show method found at GET /session/{id} -->
                                &nbsp;<a class="btn btn-small btn-success" href="{{ URL::to('session/' . $value->id) }}">Show</a>

				<!-- edit this session (uses the edit method found at GET /session/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('session/' . $value->id . '/edit') }}">Edit</a>
                                
                                <!-- create this session notes (uses the create method found at GET /sessionNotes/{id}/create -->
				<a class="btn btn-small btn-info" href="{{ URL::to('session/sessionNotes/' . $value->id . '/create') }}">Create a Session Note</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>


@stop