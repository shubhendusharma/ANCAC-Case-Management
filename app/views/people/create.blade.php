@extends('people.master')

@section('title')
@parent
:: Create Person
@stop

@section('content')

<h1>Create a Person</h1>
{{ HTML::script('js/jquery-ui/jquery-ui.js') }}
{{ HTML::style('js/jquery-ui/jquery-ui.css') }}
<div id="people" class="alert alert-warning" role="alert" style="display: none;">
    <!-- For results -->
</div>
<script type="text/javascript">
var people;
var addresses;
$(document).ready(function(){
    
    $('input#last').keyup(function() {
        $.ajax({ // ajax call starts
            url: 'search', // JQuery loads serverside.php
            type: "POST",
            data: 'last=' + $(this).val(), // Send value of the text
            dataType: 'json', // Choosing a JSON datatype
            success: function(data) // Variable data contains the data we get from serverside
            {
                people = data;
                $('#people').html(''); // Clear div
                if (jQuery.isEmptyObject(data)){
                    document.getElementById('people').style.display = 'none';
                }
                else{
                    document.getElementById('people').style.display = 'block';
                    $('#people').append('<strong>Possible Duplicates:</strong><br/>');
                    for (var i in data) {
                        $('#people').append(data[i].first + ' ' + data[i].last+' '+ data[i].dob+'<br>');

                    }
                }
            }
        });
        return false; // keeps the page from not refreshing 
    });
    
    $('input#address1').keyup(function() {
        $.ajax({ // ajax call starts
            url: '/address/search', // JQuery loads serverside.php
            type: "POST",
            data: 'line1=' + $(this).val(), // Send value of the text
            dataType: 'json', // Choosing a JSON datatype
            success: function(data) // Variable data contains the data we get from serverside
            {
                addresses = data;
                $('#addresses').html(''); // Clear div
                if (jQuery.isEmptyObject(data)){
                    document.getElementById('addresses').style.display = 'none';
                }
                else{
                    document.getElementById('addresses').style.display = 'block';
                    results = '<strong>Possible Matches:</strong><br/><table class="table" width=100%>'+
                        '<colgroup>'+
                        '<col class="col-xs-1">'+
                        '<col class="col-xs-7">'+
                        '</colgroup>';
                    for (var i in data) {
                        results += '<tr><td>'+data[i].line1 + '<br>' + data[i].line2 + data[i].city+'</td>';
                        results += '<td><button value='+i+' type="button" onclick="useAddress('+i+')" class="btn btn-default">Use</button></td></tr>';
                    }
                    $('#addresses').append(results+'</table>');
                }
            }
        });
        return false; // keeps the page from not refreshing 
    });
    
});


function useAddress(i) {
        document.getElementById('addresses').style.display = 'none'
        document.getElementById("address_id").value=addresses[i].id;
        document.getElementById("address1").value=addresses[i].line1;
        document.getElementById("address1").disabled=true;
        document.getElementById("address2").value=addresses[i].line2;
        document.getElementById("address2").disabled=true;
        document.getElementById("city").value=addresses[i].city;
        document.getElementById("city").disabled=true;
        document.getElementById("state").value=addresses[i].state;
        document.getElementById("state").disabled=true
        document.getElementById("zip").value=addresses[i].zip;
        document.getElementById("zip").disabled=true;
        document.getElementById("county_id").value=addresses[i].county_id;
        document.getElementById("county_id").disabled=true;
        document.getElementById("phone").value=addresses[i].phone;
        document.getElementById("phone").disabled=true;
        
    }
function clearAddressForm(){
        document.getElementById("address_id").value=1;
        document.getElementById("address1").value='unknown';
        document.getElementById("address1").disabled=false;
        document.getElementById("address2").value='';
        document.getElementById("address2").disabled=false;
        document.getElementById("city").value='';
        document.getElementById("city").disabled=false;
        document.getElementById("state").value='';
        document.getElementById("state").disabled=false
        document.getElementById("zip").value='';
        document.getElementById("zip").disabled=false;
        document.getElementById("county_id").value=0;
        document.getElementById("county_id").disabled=false;
        document.getElementById("phone").value='';
        document.getElementById("phone").disabled=false;
    }


  $(function() {
    $( "#dob" ).datepicker({ changeYear: true , yearRange: "c-60:c+60" , maxDate: "+0d",dateFormat: "yy-mm-dd" });
  });
  
  </script>



<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'people')) }}

	<div class="form-group">
		{{ Form::label('first', 'First Name') }}
		{{ Form::text('first', Input::old('first'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('middle', 'Middle Name') }}
		{{ Form::text('middle', Input::old('middle'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('last', 'Last Name') }}
		{{ Form::text('last', Input::old('last'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('age', 'Age') }}
		{{ Form::text('age', Input::old('age'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
            
		{{ Form::label('dob', 'Date of Birth ') }}
		{{ Form::text('dob', Input::old('dob'), array('class' => 'form-control')) }}

	</div>

        <div class="form-group">
            
		{{ Form::label('phone', 'Home Phone ') }}
		{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}

	</div>

        <div class="form-group">
            
		{{ Form::label('cellPhone', 'Cell Phone ') }}
		{{ Form::text('cellPhone', Input::old('cellPhone'), array('class' => 'form-control')) }}

	</div>

        <div class="form-group">
            
		{{ Form::label('workPhone', 'Work Phone ') }}
		{{ Form::text('workPhone', Input::old('workPhone'), array('class' => 'form-control')) }}

	</div>

	<div class="form-group">
		{{ Form::label('drugUse', 'History of Drug Use') }}
		{{ Form::checkbox('drugUse', '1', Input::old('drugUse'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('physicalAbuse', 'History of Physical Abuse') }}
		{{ Form::checkbox('physicalAbuse', '1', Input::old('physicalAbuse'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('sexAbuse', 'History of Sexual Abuse') }}
		{{ Form::checkbox('sexAbuse', '1', Input::old('sexAbuse'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('mentalHealthTreatment', 'Has had Mental Health Treatment') }}
		{{ Form::checkbox('mentalHealthTreatment', '1', Input::old('mentalHealthTreatmet'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('crimeConviction', 'Has been Convicted of a Crime') }}
		{{ Form::checkbox('cromeConviction', '1', Input::old('crimeConviction'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('employed', 'Is Employed') }}
		{{ Form::checkbox('employed', '1', Input::old('employed'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('fullTime', 'Full-time Employment') }}
		{{ Form::checkbox('fullTime', '1', Input::old('fullTime'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('activeMilitary', 'Is Active Military') }}
		{{ Form::checkbox('activeMilitary', '1', Input::old('activeMilitary'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('sexAbuseSurvivor', 'Is a Sexual Abuse Survivor') }}
		{{ Form::checkbox('sexAbuseSurvivor', '1', Input::old('sexAbuseSurvivor'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('specialNeeds', 'Has Special Needs') }}
		{{ Form::text('specialNeeds', Input::old('specialNeeds'), array('class' => 'form-control')) }}
	</div>

        
        <div class="form-group">
		{{ Form::label('language', 'Language') }}
		{{ Form::text('language', Input::old('language'), array('class' => 'form-control')) }}
	</div>
        
        
        <div class="form-group">
		{{ Form::label('maritalStatus', 'Marital Status') }}
		{{ Form::select('maritalStatus', array(
                            'married' => 'married',
                            'single' => 'Single',
                            'divorced' => 'Divorced'),
                            Input::old('maritalStatus'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
		{{ Form::label('originCountry', 'Origin Country') }}
		{{ Form::text('originCountry', Input::old('originCountry'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
		{{ Form::label('ethnicity_id', 'Ethnicity') }}
		{{ Form::select('ethnicity_id', Ethnicity::all()->lists('ethnicity','id'), Input::old('ethnicity_id'), array('class' => 'form-control')) }}
	</div>


<div id="addresses" class="alert alert-info" role="alert" style="display: none;">
    <!-- For results -->
</div>
<button  type='button' onclick="clearForm()" class="btn btn-default">Clear Address</button><br>

        {{ Form::hidden('address_id' , 1, array('id' => 'address_id')) }}

        <div class="form-group">
		{{ Form::label('address1', 'Address Line 1') }}
		{{ Form::text('address1', Input::old('address1'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('address2', 'Address Line 2') }}
		{{ Form::text('address2', Input::old('address2'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('city', 'City') }}
		{{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('state', 'State') }}
		{{ Form::text('state', Input::old('state'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('zip', 'Zip Code') }}
		{{ Form::text('zip', Input::old('zip'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('county_id', 'County') }}
		{{ Form::select('county_id', County::all()->lists('name','id'), Input::old('county_id'), array('class' => 'form-control')) }}
	</div>


	{{ Form::submit('Create the person entry!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop