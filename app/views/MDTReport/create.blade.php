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
    
    $(function() {
    $( "#frmDate" ).datepicker({ changeYear: true , yearRange: "c-0:c+60" , maxDate: "+1y",dateFormat: "yy-mm-dd" });
    });
    $(function() {
    $( "#toDate" ).datepicker({ changeYear: true , yearRange: "c-0:c+60" , maxDate: "+1y",dateFormat: "yy-mm-dd" });
    });
    
   
        $('#select-all').click(function(){
            $('container input[type="chekbox"]').prop('checked',this.checked);
        });
  
    
</script>
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
    {{ Form::open(array('url' =>'MDTReportFtr', 'method'=>'get'))}}
    <div class="form-group">
        {{Form::label('allOpen','Open Cases Only')}}
        {{Form::checkbox('selOpnCases',true)}}
        {{Form::label('frmDate','From Date:')}}
        {{Form::text('frmDate')}}
        {{Form::label('toDate','To Date:')}}
        {{Form::text('toDate', date('Y-m-d'))}}
        
    </div>
    {{Form::submit('apply',array('class' =>'btn btn-small'))}}
    {{Form::close()}}
    

{{ Form::open(array('url' => 'MDTReport')) }}
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Select</td>
                        <td>Case #</td>
                        <td>Victim Name</td>
                        
		</tr>
	</thead>
        {{Form::label('select-all','Select All')}}
        {{ Form::checkbox('select-all', true) }}
	<tbody>
            
            <div id="pad" class="form-group">
		{{ Form::label('date', 'Date of Meeting (YYYY-MM-DD)') }}
		{{ Form::text('date', Input::old('date'), array('class' => 'form-control')) }}
            </div>
              
            <div id="pad" class="form-group">
		{{ Form::label('location', 'Location') }}
		{{ Form::text('location'," ", array('class' => 'form-control')) }}
            </div>
            @if(count($cases) > 1)
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
        @endif
	</tbody>
</table>
{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
{{Form::close()}}
@stop