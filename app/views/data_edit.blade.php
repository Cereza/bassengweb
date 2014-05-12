@extends('default')

@section('content')

<!--
    The view file for editing a measurement/task.
-->

<br>
	
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
 
                <br>

                <h2><span class="glyphicon glyphicon-cog"></span> Redigerer måling/oppgave med ID : <b>{{ $data->id }} </b> </h2>

                <hr> 
            </div>
    
            <div class="row">
                {{ Form::open(array('url' => 'bassengweb/updateData', 'method' => 'PUT')) }}
                <div class="col-md-12">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-4 control-label pull right"> {{ Form::label('tittel', 'Tittel') }}</label>
                        </div>
					    <div class="col-md-4">  
                            @if($data->tasks->isEmpty())
                                {{ Form::text('tittel', $data->measurements[0]->title, array('disabled','class' => 'form-control' )) }}
                                {{ Form::hidden('title', $data->measurements[0]->title) }}
                            @else
                                {{ Form::text('tittel', $data->tasks[0]->title, array('disabled', 'class' => 'form-control')) }}
                                {{ Form::hidden('title', $data->tasks[0]->title) }}
                            @endif
                            {{ Form::hidden('id', $data->id) }}
					   </div>
				    </div>
                </div>
            </div>
    
            <br>
    
            <div class="row">
                <div class="col-md-7">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('value', 'Verdi') }} </label>
                        </div>
					    <div class="col-md-5">
                            {{ Form::text('value', $data->value, array('class' => 'form-control' )) }}
                            {{ Form::hidden('value_old', $data->value) }}
					    </div>
				    </div>
                </div>
            </div>
    
            <br>

            <div class="row">
                <div class="col-md-7">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('date', 'Dato') }} </label>
                        </div>
					    <div class="col-md-5">
                            {{ Form::text('date', date('d/m/Y', strtotime($data->date)), array('class' => 'form-control' )) }}
                            {{ Form::hidden('saved_date', $data->date) }}
					   </div>
				    </div>
                </div>
            </div>
    
            <br>    
    
            <div class="row">
                <div class="col-md-7">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('time', 'Tid') }} </label>
                        </div>
					    <div class="col-md-5">
                            {{ Form::text('time', $data->time, array('class' => 'form-control' )) }}
					    </div>
				    </div>
                </div>
            </div>

            <br>
     
            <div class="row">
                <div class="col-md-7">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('emp', 'Ansatt') }} </label>
                        </div>
					    <div class="col-md-5">
                            {{ Form::select('emp', $emp, $data->emp_id, array('class' => 'form-control' )) }}
                            {{ Form::hidden('changed_by', Auth::user()->user_name) }}       
					    </div>
				    </div>
                </div>
            </div>
    
            <br>
    
            <div class="row">    
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        {{ Form::submit('Lagre endringer', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop