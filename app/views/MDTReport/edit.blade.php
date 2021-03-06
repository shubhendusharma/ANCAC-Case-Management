@extends('MDTReport.master')

@section('title')
@parent
:: Create MDTReport
@stop

@section('content')

<h1>MDT Report</h1>
{{ HTML::script('js/jquery-ui/jquery-ui.js') }}
{{ HTML::style('js/jquery-ui/jquery-ui.css') }}
<script>
 $(function() {
    $( "#date" ).datepicker({ changeYear: true , yearRange: "c-0:c+60" , maxDate: "+1y",dateFormat: "yy-mm-dd" });
  });
</script>
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($MDTReport, array('route' => array('MDTReport.update', $MDTReport->id), 'method' => 'PUT')) }}
	
    <div id="pad" class="form-group">
		{{ Form::label('date', 'Date of Meeting (YYYY-MM-DD)') }}
		{{ Form::text('date', Input::old('date'), array('class' => 'form-control')) }}
            </div>
              
            <div id="pad" class="form-group">
		{{ Form::label('location', 'Location') }}
		{{ Form::text('location',Input::old('location'), array('class' => 'form-control')) }}
            </div>
    
    <h2>Currently selected cases:</h2>
 <table class="table table-striped table-bordered">
   <thead>
		<tr>
			<td>Select</td>
                        <td>Case #</td>
                        <td>Victim Name</td>
                        
		</tr>
	</thead>
	<tbody>
            
            
            
        
            @foreach($MDTReport->cases as $key => $value)
            
            
                <tr>
                        <td><div class="checkbox">
                        <label>
                        {{ Form::checkbox('case[]', $value->case_id,"check") }}
                        </label>
                        </div></td>
                        <td>{{$value->info->caseNumber}}</td>
                        <td>{{$value->info->abusedChild->PersonalInfo->name}}</td>                      
		</tr>
                <tr>
                    <td colspan="3">
                        <div id="pad" class="form-group">
		{{ Form::label('recommendation', 'Recommendation') }}
		{{ Form::textarea('recommendation[]'," ",array('class' => 'form-control')) }}
                        </div>
                    </td>
                </tr>

	@endforeach
                
                	</tbody>
</table>        
             <h2>Other cases:</h2>
    <table class="table table-striped table-bordered">

            <thead>
		<tr>
			<td>Select</td>
                        <td>Case #</td>
                        <td>Victim Name</td>
                        
		</tr>
	</thead>
	<tbody>
            
        @foreach($cases as $key => $value)
            
            
                <tr>
                        <td><div class="checkbox">
                        <label>
                        {{ Form::checkbox('case[]', $value->id) }}
                        </label>
                        </div></td>
                        <td>{{$value->caseNumber}}</td>
                        <td>{{$value->abusedChild->PersonalInfo->name}}</td>                      
		</tr>
                <tr>
                    <td colspan="3">
                        <div id="pad" class="form-group">
		{{ Form::label('recommendation', 'Recommendation') }}
		{{ Form::textarea('recommendation[]'," ",array('class' => 'form-control')) }}
                        </div>
                    </td>
                </tr>
	@endforeach
	</tbody>
</table>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
{{Form::close()}}
@stop