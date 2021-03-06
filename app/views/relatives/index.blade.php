@extends('relatives.master')

@section('title')
@parent
:: Relative
@stop

@section('content')

<h1>All the Relations</h1>
<a class="btn btn-small btn-success" href="..">Back to Dashboard</a>
<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
                        <td>Abuse Child</td>
                        <td>Person</td>
			<td>Type of relation</td>
			<td>Custodian</td>
                        <td>Same House</td>
			<td>Nickname of Related Person</td>
                        <td>Alleged Offender</td>
		</tr>
	</thead>
	<tbody>
	@foreach($relatives as $key => $value)
		<tr>
                        <td>{{ $value->child->personalInfo->name }}</td>
                        <td>{{ $value->personalInfo->name }}</td>
                        <td>{{ $value->relationType->type }}</td>
                        @if ($value->custodian)
			<td>yes</td>
                        @else
                        <td>no</td>
                        @endif
                        @if ($value->sameHouse)
			<td>yes</td>
                        @else
                        <td>no</td>
                        @endif
			<td>{{ $value->alias }}</td>
                        

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the child (uses the destroy method DESTROY /children/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				<a{{ Form::open(array('url' => 'relatives/' . $value->id, 'class' => 'pull-left')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                        {{ Form::close() }}
                                </a>

				<!-- show the child (uses the show method found at GET /children/{id} -->
                                &nbsp;<a class="btn btn-small btn-success" href="{{ URL::to('relatives/' . $value->id) }}">Show</a>

				<!-- edit this child (uses the edit method found at GET /children/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('relatives/' . $value->id . '/edit') }}">Edit</a>
     

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

@stop

