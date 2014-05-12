@extends('default')

@section('content')

<!--
  The view file for the confirmation page for deactivating users.
-->
	
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
 
        <br>

        <h2><span class="glyphicon glyphicon-cog"></span> Bekreft sletting av måling/oppgave med ID : <b> {{ $data->id }} </b> </h2>

        <hr>    
    
      </div>
    
      <div class="row">
        {{ Form::open(array('url' => 'bassengweb/deleteData', 'method' => 'DELETE')) }}
        {{ Form::hidden('id', $data->id) }}
	      <div class="col-md-12">
	   			<div class="form-group">
            <div id="center-right">
					   <label class="col-md-4 control-label pull right"> Tittel:  </label>
            </div>
					  <div class="col-md-4">  
              @if($data->tasks->isEmpty())   
                {{ Form::text('tittel',  $data->measurements[0]->title, array('disabled','class' => 'form-control' )) }}
            </div>
				  </div>
			  </div>
      </div>
    
      <br>
    
      <div class="row">
  		  <div class="col-md-12">
          <div class="form-group">
            <div id="center-right">
				      <label class="col-md-4 control-label pull right"> Basseng:  </label>
            </div>
				    <div class="col-md-4">  
              {{ Form::text('Basseng',  $pools[$data->measurements[0]->pivot->pool_id], array('disabled','class' => 'form-control' )) }}    
              {{ Form::hidden('title', $data->measurements[0]->title) }}            
				    </div>
          </div>
		    </div>
      </div>
    
      <div class="row">
        <div class="col-md-12">
				  <div class="form-group">
            <div id="center-right">
					   <label class="col-md-4 control-label pull right"> </label>
            </div>
	          <div class="col-md-4">  
              @else
                {{ Form::text('Tittel', $data->tasks[0]->title, array('disabled','class' => 'form-control' )) }}    
                {{ Form::hidden('title', $data->tasks[0]->title) }}
              @endif   
            </div>
				  </div>
			  </div>
      </div>
     
      <br>
    
      <div class="row">	
        <div class="col-md-12">
			   	<div class="form-group">
            <div id="center-right">
              <label class="col-md-4 control-label pull right"> Verdi: </label>
            </div>
					  <div class="col-md-4">  
              {{ Form::text('Verdi',$data->value, array('disabled','class' => 'form-control' )) }}
              {{ Form::hidden('value_old', $data->value) }}
            </div>
				  </div>
			  </div>
      </div>
      
      <br>   
      
      <div class="row">	
        <div class="col-md-12">
				  <div class="form-group">
            <div id="center-right">
					    <label class="col-md-4 control-label pull right"> Dato: </label>
            </div>
					  <div class="col-md-4">  
              {{ Form::text('Dato', date('d/m/Y', strtotime($data->date)), array('disabled','class' => 'form-control' )) }}
              {{ Form::hidden('saved_date', $data->date) }}  
					  </div>
				  </div>
			  </div>
      </div>
                 
      <br>
    
      <div class="row">	
        <div class="col-md-12">
				  <div class="form-group">
            <div id="center-right">
              <label class="col-md-4 control-label pull right"> Tid: </label>
            </div>
  					<div class="col-md-4">  
              {{ Form::text('Dato', $data->time , array('disabled','class' => 'form-control' )) }}
              {{ Form::hidden('time', $data->time) }}
            </div>
				  </div>
			  </div>
      </div>
    
      <br>
    
      <div class="row">	
        <div class="col-md-12">
				  <div class="form-group">
            <div id="center-right">
					    <label class="col-md-4 control-label pull right"> Ansatt: </label>
            </div>
					  <div class="col-md-4">  
              {{ Form::text('Dato', $data->emps->user_name , array('disabled','class' => 'form-control' )) }}
              {{ Form::hidden('changed_by', Auth::user()->user_name) }}  
					  </div>
				  </div>
			  </div>
      </div>
    
      <br>
	 
      <div class="row">    
        <div class="form-group">
          <div class="col-md-offset-5 col-md-5">
            {{ Form::submit('Slett', array('class' => 'btn btn-danger btn-lg')) }}
          </div>
        </div>
      </div>
      {{ Form::close() }}

@stop