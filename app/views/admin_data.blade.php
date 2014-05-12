@extends('default')

@section('content')

<!--
  The view file that shows an admin information about the account,
  also provides the admin with options to create, edit, activate and
  deactivate a user along with the ability to view a changelog.
-->

<br>

<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-lg-12"> 
        <br>
        <h2><span class="glyphicon glyphicon-cog"></span> Min side </h2>
        <hr>
      
        <div id="response" > <!-- Handles the success messages. -->
          @if(Session::has('message'))
            <div class="alert alert-success">
              <p>{{ Session::get('message') }}</p>
            </div>
        </div>
          @endif

      </div>
    
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="list">
            <a type="button" class="list-group-item">{{ 'Ansatt ID : '.$user->id }}</a>
            <a type="button" class="list-group-item">{{ 'Navn : '.$user->first_name.' '.$user->last_name }}</a>  
            <a type="button" class="list-group-item">{{ 'E-post : '.$user->email }}</a>  
            <a type="button" class="list-group-item">{{ 'Brukernavn : '.$user->user_name }}</a>  
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="well">
          <div id="center">
            {{ HTML::linkRoute('create_user', 'Opprett Bruker', array(), array('class' => 'btn btn-primary')) }}  
            {{ HTML::linkRoute('change_log', 'Endringslogg', array(), array('class' => 'btn btn-primary')) }} 
          </div>
        </div>
      </div>  
    
      <div id="center"> <h3>Bruker endringer <span class="glyphicon glyphicon-user"></span></h3></div>
        
      <div class="well">
        <div class="row">
          <div class="form-group">
            <label  class="col-md-4 control-label">Velg bruker som skal redigeres: </label>
            <div class="col-md-5">
              {{ Form::open(array('url' => 'bassengweb/edit_user', 'method' => 'GET')) }} 
              {{ Form::select('empId', $emps, Input::old('empId'), array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Rediger Bruker', array('class' => 'btn btn-info')) }}
            {{ Form::close() }}
          </div>                         
        </div>
      </div>
  
      <br>
  
      <div class="well">
        <div class="row">
          <div class="form-group">
            <label  class="col-md-4 control-label">Velg bruker som skal aktiveres: </label>
            <div class="col-md-5">
              {{ Form::open(array('url' => 'bassengweb/ressurect_user', 'method' => 'PUT')) }}   
              {{ Form::select('actEmpId', $deactEmps, Input::old('actEmpId'), array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Aktiver Bruker', array('class' => 'btn btn-success')) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
 
      <br>
  
      <div class="well">
        <div class="row"> 
          <div class="form-group">
            <label  class="col-md-4 control-label">Velg bruker som skal deaktiveres: </label>
            <div class="col-md-5">
              {{ Form::open(array('url' => 'bassengweb/delete_user', 'method' => 'GET')) }}
              {{ Form::select('delEmpId', $emps, Input::old('delEmpId'), array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Deaktiver Bruker', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>   
  </div>     
</div>

<br>

@stop