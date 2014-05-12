@extends('default')

@section('content')

<!--
	The view file for Søk on a user account, this page
	displays data from the database filtered on criteria.
-->

<div class="jumbotron" >
	<div class="container" >
		<div class="row" >
			<div class="col-lg-12" >

	    		<br>

				<h2><span class="glyphicon glyphicon-search"></span> Søk </h2>

				<hr>
	     
	    		<div id="response" > 
	        		@if(Session::has('message'))
	        			<div class="alert alert-success">
	            			<p>{{ Session::get('message') }}</p>
	        			</div>
	    		</div>
		   			@endif

				<div id="response" > 
	    			@if(Session::has('noData'))
	    				<div class="alert alert-danger">
							<p>{{ Session::get('noData') }}</p>
	    				</div>
	      		</div>
					@endif

			</div>
   		</div>
	</div>
    
    <div class="row">
        {{ Form::open(array('url' => 'bassengweb/data', 'method' => 'GET' )) }}
			<div class="col-md-5">
				<div class="form-group">
					<label class="col-md-5 col-lg-6 control-label">{{ Form::label('fraDato', 'Fra dato: ') }} </label>
					<div class="col-md-6 col-lg-6">
					  {{ Form::text('fraDato', Input::old('fraDato'), array('placeholder' => $date, 'class' => 'form-control')) }}
					</div>
				</div>
			</div>

        <div class="col-md-5 text-left-imp"> 
		
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('tilDato', 'Til dato: ') }} </label>
					<div class="col-md-6 col-lg-6">
				{{ Form::text('tilDato', Input::old('tilDato'), array('placeholder' => $date, 'class' => 'form-control')) }}
					</div>
				</div>
	</div>
	</div>
    
    <br>
    
     <div class="row">
          
			<div class="col-md-5">
				<div class="form-group">
					<label class="col-md-5 col-lg-6 control-label">{{ Form::label('fraTid', 'Fra klokka: ') }} </label>
					<div class="col-md-6 col-lg-6">
					 {{ Form::text('fraTid', Input::old('fraTid'), array('placeholder' => '10:55:31', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>

        <div class="col-md-5 text-left-imp"> 
		
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('tilTid', 'Til klokka: ') }} </label>
					<div class="col-md-6 col-lg-6">
				{{ Form::text('tilTid', Input::old('tilTid'), array('placeholder' => '10:55:31', 'class' => 'form-control')) }}
					</div>
				</div>
		
	       </div>
	</div>
 
    
    <hr>
    

  <br>
      
    <div class="row">
        
        <div class="col-md-8"> 
		
			<div class="form-group">
				<label class="col-md-4 col-lg-4 control-label">{{ Form::label('pool_id', 'Basseng:') }} </label>
					<div class="col-md-6 col-lg-6">
                        {{ Form::select('pool_id', $pools, Input::old('pool_id'), array('class' => 'form-control')) }} 
					</div>
				</div>
		
	       </div>
         <div class="col-md-4 text-left-imp">
				<div class="form-group">
					<label class="col-md-6 control-label">{{ Form::label('time_maling', 'Timemåling') }} </label>
					<div class="col-md-3">
					   {{ Form::radio('kriteria', 'time_maling') }}
					</div>
				</div>
			</div>
        
          
        
	</div>
    
    
    <div class="row">
        
        <div class="col-md-4"> 
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('vann_maling', 'Vannmåling') }} </label>
					<div class="col-md-6 col-lg-6">
					{{ Form::radio('kriteria', 'vann_maling') }}
					</div>
				</div>
	       </div>
        
            <div class="col-md-4">
				<div class="form-group">
					<label class="col-md-6 col-lg-6 control-label">{{ Form::label('oppgaver', 'Oppgaver') }} </label>
					<div class="col-md-6 col-lg-6">
					 {{ Form::radio('kriteria', 'oppgaver') }}
					</div>
				</div>
			</div>
        
       

      
      
        <div class="col-md-4 text-left-imp"> 
				<div class="form-group">
					<label class="col-md-6 col-lg-6 control-label">{{ Form::label('arduino', 'Automatikk') }} </label>
					<div class="col-md-6 col-lg-6">
					  {{ Form::radio('kriteria', 'arduino') }}
					</div>
				</div>
			</div>
        
	</div>
      
    <hr>
    
    <div class="row">
        <div class="col-md-4">
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('dagsoppg', 'Dagvakt') }} </label>
				<div class="col-md-6 col-lg-6">
					{{ Form::radio('kriteria', 'dagsoppg') }}
				</div>
            </div>
		</div>
        
        <div class="col-md-4 text-left-imp"> 
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('kveldsoppg', 'Kveldsvakt') }} </label>
				<div class="col-md-6 col-lg-6">
					{{ Form::radio('kriteria', 'kveldsoppg') }}
				</div>
			</div>
		</div>
        
		<div class="col-md-4">
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('helgoppg', 'Helgevakt') }} </label>
				<div class="col-md-6 col-lg-6">
					{{ Form::radio('kriteria', 'helgoppg') }}
				</div>
			</div>
		</div>
       
        <div class="col-md-4 text-left-imp"> 
			<div class="form-group">
				<label class="col-md-6 col-lg-6 control-label">{{ Form::label('kontcm', 'Kontroll CM') }} </label>
				<div class="col-md-6 col-lg-6">
					{{ Form::radio('kriteria', 'kontcm') }}
				</div>
			</div>
		</div>
        
        <div class="form-group">
    		<div class="col-md-offset-8 col-md-7">
       			{{ Form::submit('Søk', array('class' => 'btn btn-primary btn-lg')) }}
    		</div>
  		</div>
        {{ Form::close() }}
	</div>
    
    <br>

	@if(isset($data))
		<table  class='table table-hover'>
			<tr class='active'>
				<td>ID</td>
				<td>Tittel</td>
				<td>Verdi</td>
				<td>Ansatt</td>
				<td>Dato</td>
				<td>Tid</td>
		@if($type === 'measurement')
				<td>Basseng</td>
                
			</tr>
			@foreach($data as $dataItem)
				<tr>
					<td>{{ $dataItem->id }}</td>
					<td>{{ $dataItem->measurements[0]->title }}</td>
					<td>{{ $dataItem->value }}</td>
					<td>{{ $dataItem->emps->user_name }}</td>
					<td>{{ date('d/m/Y', strtotime($dataItem->date)) }}</td>
					<td>{{ $dataItem->time }}</td>
					@foreach($dataItem->measurements as $measurement)
						<td>{{ $pools[$measurement->pivot->pool_id] }}</td>
					@endforeach
					
			</tr>
			@endforeach
		</table>
     	<div id="center">
			{{ $data->appends(array_merge(array($type => 1), Input::except('page')))->links() }}
        </div>
		@elseif($type === 'task')
           
			</tr>
			@foreach($data as $dataItem)
				<tr>
					<td>{{ $dataItem->id }}</td>
					<td>{{ $dataItem->tasks[0]->title }}</td>
					<td>{{ $dataItem->value }}</td>
					<td>{{ $dataItem->emps->user_name }}</td>
					<td>{{ date('d/m/Y', strtotime($dataItem->date)) }}</td>
					<td>{{ $dataItem->time }}</td>    
				</tr>
			@endforeach
			</table>
            <div id="center">
				{{ $data->appends(array_merge(array($type => 1), Input::except('page')))->links() }}
		    </div>
</div>

		@endif
	@endif

@stop