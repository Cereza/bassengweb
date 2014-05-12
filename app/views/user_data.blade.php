@extends('default')

@section('content')

<!--
  The view file for minside which shows the user data about the account
-->

<br>
	
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <br>

        <h2><span class="glyphicon glyphicon-cog"></span> Min side </h2>

        <hr>
         
          <div id="response" > 
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
    </div>
  </div>
</div>
@stop