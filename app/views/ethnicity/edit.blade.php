<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('ethnicity') }}">Ethnicity</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('ethnicity') }}">View All Ethnicity</a></li>
		<li><a href="{{ URL::to('ethnicity/create') }}">Create a Ethnicity</a>
	</ul>
</nav>

<h1>Edit {{ $ethnicity->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($ethnicity, array('route' => array('ethnicity.update', $ethnicity->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('ethnicity', 'ethnicity') }}
		{{ Form::text('ethnicity', null, array('class' => 'form-control')) }}
	</div>



	{{ Form::submit('Edit the Ethnicity!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>