<!-- app/views/relatives/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>ANCAC Relatives</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('relatives') }}">Relations</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('relatives') }}">View All Relations</a></li>
		<li><a href="{{ URL::to('relatives/create') }}">Create a Relation Entry</a>
	</ul>
</nav>

<h1>All the Relations</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
                        <td>ID</td>
                        <td>Abuse Child ID</td>
                        <td>Person ID</td>
			<td>Type of relation</td>
			<td>Custodian</td>
                        <td>Same House</td>
			<td>Name of Related Person</td>
                        <td>Alleged Offender</td>
		</tr>
	</thead>
	<tbody>
	@foreach($relatives as $key => $value)
		<tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->abusedChild_id }}</td>
                        <td>{{ $value->person_id }}</td>
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
				{{ Form::open(array('url' => 'relatives/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this relatives', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

				<!-- show the child (uses the show method found at GET /children/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('relatives/' . $value->id) }}">Show this Relation</a>

				<!-- edit this child (uses the edit method found at GET /children/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('relatives/' . $value->id . '/edit') }}">Edit this Relation</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>


</div>
</body>
</html>

