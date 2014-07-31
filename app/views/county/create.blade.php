<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('county') }}">County</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('county') }}">View All County</a></li>
		<li><a href="{{ URL::to('county/create') }}">Create a County</a>
	</ul>
</nav>

<h1>Create a Worker Type</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'county')) }}

	<div class="form-group">
		{{ Form::label('name', 'name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>


	{{ Form::submit('Create the Worker Type!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>
