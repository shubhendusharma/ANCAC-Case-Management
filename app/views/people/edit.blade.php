@extends('people.master')

@section('title')
@parent
:: Edit Person
@stop

@section('content')

<style>
    #pad{padding: 8px}
</style>
<h1>Edit {{ $person->name }}</h1>
{{ HTML::script('js/jquery-ui/jquery-ui.js') }}
{{ HTML::style('js/jquery-ui/jquery-ui.css') }}


<script type="text/javascript">
var addresses;
$(document).ready(function(){
    
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
                        results += '<td><button value='+i+' type="button" onclick="use('+i+')" class="btn btn-default">Use</button></td></tr>';
                    }
                    $('#addresses').append(results+'</table>');
                }
            }
        });
        return false; // keeps the page from not refreshing 
    });
});

function use(i) {
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
function clearForm(){
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
{{ HTML::ul($errors->all()) }}

{{ Form::model($person, array('route' => array('people.update', $person->id), 'method' => 'PUT')) }}

<div id="pad" class="form-inline">
	<div id="pad" class="form-group">
		{{ Form::label('first', 'First Name') }}
		{{ Form::text('first', Input::old('first'), array('class' => 'form-control','autofocus')) }}
	</div>

	<div id="pad" class="form-group">
		{{ Form::label('middle', 'Middle Name') }}
		{{ Form::text('middle', Input::old('middle'), array('class' => 'form-control')) }}
	</div>

	<div id="pad" class="form-group">
		{{ Form::label('last', 'Last Name') }}
		{{ Form::text('last', Input::old('last'), array('class' => 'form-control')) }}
	</div>

	<div id="pad" class="form-group">
		{{ Form::label('age', 'Age') }}
		{{ Form::text('age', Input::old('age'), array('class' => 'form-control')) }}
	</div>
        
        <div id="pad" class="form-group">
            
		{{ Form::label('dob', 'Date of Birth ') }}
		{{ Form::text('dob', Input::old('dob'), array('class' => 'form-control')) }}

	</div>

        <div id="pad" class="form-group">
		{{ Form::label('gender', 'Gender') }}
		{{ Form::select('gender', array('0' => 'Male', '1' => 'Female',), 
                    Input::old('gender'), array('class' => 'form-control')) }}
	</div>
    
        <div id="pad" class="form-group">
		{{ Form::label('ethnicity_id', 'Ethnicity') }}
		{{ Form::select('ethnicity_id', Ethnicity::all()->lists('ethnicity','id'), Input::old('ethnicity_id'), array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
            
		{{ Form::label('phone', 'Home Phone ') }}
		{{ Form::text('phone', $person->address->phone, array('class' => 'form-control')) }}

	</div>

        <div id="pad" class="form-group">
            
		{{ Form::label('cellPhone', 'Cell Phone ') }}
		{{ Form::text('cellPhone', Input::old('cellPhone'), array('class' => 'form-control')) }}

	</div>

        <div id="pad" class="form-group">
            
		{{ Form::label('workPhone', 'Work Phone ') }}
		{{ Form::text('workPhone', Input::old('workPhone'), array('class' => 'form-control')) }}

	</div>

	<div id="pad" class="form-group">
		{{ Form::label('specialNeeds', 'Has Special Needs') }}
		{{ Form::text('specialNeeds', Input::old('specialNeeds'), array('class' => 'form-control')) }}
	</div>

        
        <div id="pad" class="form-group">
		{{ Form::label('language', 'Language') }}
		{{ Form::text('language', Input::old('language'), array('class' => 'form-control')) }}
	</div>
        
        
        <div id="pad" class="form-group">
		{{ Form::label('maritalStatus', 'Marital Status') }}
		{{ Form::select('maritalStatus', array(
                            'married' => 'married',
                            'single' => 'Single',
                            'divorced' => 'Divorced'),
                            Input::old('maritalStatus'), array('class' => 'form-control')) }}
	</div>
        
        <div id="pad" class="form-group">
		{{ Form::label('countryOrigin_id', 'Country Origin') }}
                {{ Form::select('countryOrigin_id', CountryOrigin::all()->lists('country','id'), Input::old('countryOrigin_id'), array('class' => 'form-control')) }}
        </div>

    <br>

<div id="addresses" class="alert alert-info" role="alert" style="display: none;">
    <!-- For results -->
</div>
<button id="pad"  type='button' onclick="clearForm()" class="btn btn-default">Clear Address</button><br>

        {{ Form::hidden('address_id' , 1, array('id' => 'address_id')) }}
        <div id="pad" class="form-group">
		{{ Form::label('address1', 'Address Line 1') }}
		{{ Form::text('address1', $person->address->line1, array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('address2', 'Address Line 2') }}
		{{ Form::text('address2', $person->address->line2, array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('city', 'City') }}
		{{ Form::text('city', $person->address->city, array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('state', 'State') }}
		{{ Form::text('state', $person->address->state, array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('zip', 'Zip Code') }}
		{{ Form::text('zip', $person->address->zip, array('class' => 'form-control')) }}
	</div>

        <div id="pad" class="form-group">
		{{ Form::label('county_id', 'County') }}
		{{ Form::select('county_id', County::all()->lists('name','id'), $person->address->county_id, array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-horizontal">

    <div class="checkbox">
        <label>
        		
            {{ Form::checkbox('drugUse', '1', Input::old('drugUse')) }}
            <b>History of Drug Use</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
            {{ Form::checkbox('physicalAbuse', '1', Input::old('physicalAbuse')) }}
            <b>History of Physical Abuse</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
            {{ Form::checkbox('sexAbuse', '1', Input::old('sexAbuse')) }}
            <b>History of Sexual Abuse</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
            {{ Form::checkbox('mentalHealthTreatment', '1', Input::old('mentalHealthTreatmet')) }}
            <b>Has had Mental Health Treatment</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
           {{ Form::checkbox('crimeConviction', '1', Input::old('crimeConviction')) }}
            <b>Has been Convicted of a Crime</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
           {{ Form::checkbox('employed', '1', Input::old('employed')) }}
            <b>Is Employed</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
           {{ Form::checkbox('fullTime', '1', Input::old('fullTime')) }}
            <b>Full-time Employment</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
          {{ Form::checkbox('activeMilitary', '1', Input::old('activeMilitary')) }}
            <b>Is Active Military</b>

        </label>
    </div>
    <div class="checkbox">
        <label>
        		
          {{ Form::checkbox('sexAbuseSurvivor', '1', Input::old('sexAbuseSurvivor')) }}
            <b>Is a Sexual Abuse Survivor</b>

        </label>
    </div>
</div>
<br>
	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop