<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('workerType') }}">Abuse Type Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('workerType') }}">View All Abuse Types</a></li>
		<li><a href="{{ URL::to('workerType/create') }}">Create a Abuse Type</a>
	</ul>
</nav>

<h1>Showing {{ $WorkerType->type }}</h1>


</div>
</body>
</html>

