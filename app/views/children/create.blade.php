<!-- app/views/children/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('children') }}">Child entries</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('children') }}">View All children</a></li>
		<li><a href="{{ URL::to('children/create') }}">Create a child entry</a>
	</ul>
</nav>

<h1>Create a child</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'children')) }}


	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
		{{ Form::label('dob', 'Date of birth (YYYY-MM-DD)') }}
		{{ Form::text('dob', Input::old('dob'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('parentalHistory', 'Parental History') }}
		{{ Form::text('parentalHistory', Input::old('parentalHistory'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('parentStatus', 'Parent Status') }}
		{{ Form::text('parentStatus', Input::old('parentStatus'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('medicalCompleted', 'Is Medical Completed') }}
		{{ Form::checkbox('medicalCompleted', '1', Input::old('medicalCompleted'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('medicalLocation', 'Medical Location') }}
		{{ Form::text('medicalLocation', Input::old('medicalLocation'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('schoolGrade', 'school Grade') }}
		{{ Form::text('schoolGrade', Input::old('schoolGrade'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('school', 'school') }}
		{{ Form::text('school', Input::old('school'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('specialNeeds', 'has special needs') }}
		{{ Form::checkbox('specialNeeds', '1', Input::old('specialNeeds'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('disability', 'is disabled') }}
		{{ Form::checkbox('disability', '1', Input::old('disability'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('language', 'Language') }}
		{{ Form::text('language', Input::old('language'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('originCountry', 'originCountry') }}
		{{ Form::text('originCountry', Input::old('originCountry'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
		{{ Form::label('address_id', 'address_id') }}
		{{ Form::text('address_id', Input::old('address_id'), array('class' => 'form-control')) }}
	</div
        
        <div class="form-group">
		{{ Form::label('household_id', 'household_id') }}
		{{ Form::text('household_id', Input::old('household_id'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
		{{ Form::label('ethnicity_id', 'ethnicity_id') }}
		{{ Form::text('ethnicity_id', Input::old('ethnicity_id'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the child entry!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>