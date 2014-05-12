@extends('default')

@section('content')

<!--
  The view page which acts as a confirmation for deactivating a user.
  This page shows information about the user being deactivated.
-->

<br>
	
<div class="jumbotron" >
  <div class="container" >
    <div class="row" >
      <div class="col-lg-12" >
        
        <br>
        
        <h2><span class="glyphicon glyphicon-remove"></span> Bekreft deaktivering av brukeren til: <b> {{ $user->first_name.' '.$user->last_name }} </b></h2>
        <hr>
            
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="list">
              <a type="button" class="list-group-item">{{ 'Ansatt ID: '.$user->id }}</a>
              <a type="button" class="list-group-item">{{ 'Navn: '.$user->first_name.' '.$user->last_name }}</a>  
              <a type="button" class="list-group-item">{{ 'E-post: '.$user->email }}</a>  
              <a type="button" class="list-group-item">{{ 'Brukernavn: '.$user->user_name }}</a>   
              <a type="button" class="list-group-item">{{ 'Brukertype: '.$user->user_type }}</a>  
            </div>
          </div>
        </div>

        {{ Form::open(array('url' => 'bassengweb/purge_user', 'method' => 'DELETE')) }}
        {{ Form::hidden('id', $user->id) }}

        <div class="row">    
          <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
              {{ Form::submit('Deaktiver '. $user->first_name.' '.$user->last_name, array('class' => 'btn btn-danger btn-lg')) }}
            </div>
          </div>
        </div>
        {{ Form::close() }}
	    </div>
    </div>
  </div>
</div>

@stop