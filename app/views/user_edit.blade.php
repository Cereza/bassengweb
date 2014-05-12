@extends('default')

@section('content')

<!--
    The view file for editing a user stored in the DB.
    Automatically shows the current data for the user being edited.
    Also contains flash messages for showing errors/success.
-->
 
<div class="jumbotron" >
    <div class="container" >
        <div class="row" >
            <div class="col-lg-12" >
                <br>
                    <h2><span class="glyphicon glyphicon-edit"></span> {{ $title }}: <b> {{ $user->first_name.' '.$user->last_name }}</b></h2>
                    <div class="row">
                        <div id="center">
                            <p><small>Opprettet: {{ date('d/m/Y H:i:s', strtotime($user->created_at)) }} | 
                            Sist oppdatert: {{ date('d/m/Y H:i:s', strtotime($user->updated_at)) }}</small></p>
                        </div>
                    </div>
                    <hr>
                    <div id="response" > <!-- Handles flash error messages -->
                        @if(Session::has('message'))
                            <div class="alert alert-danger">
                                <div id="svart"><li>{{ Session::get('message') }}</li></div>
                            </div>
                    </div>
                        @endif
                        @foreach ($errors->all() as $errors) <!-- Handles validation error messages -->
                            <div class="alert alert-danger"> 
                                <div id="svart"><li>{{ $errors }}</li></div>
                            </div>
                        @endforeach
            </div>

            <div class="row">
                {{ Form::open(array('url' => 'bassengweb/update_user', 'method' => 'PUT')) }} <!-- The form for updating the user -->
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('emp_id', 'Ansatt ID: ') }} </label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::text('emp_id', $user->id, array('disabled',  'class' => 'form-control')) }}  
                        </div>
                            {{ Form::hidden('id', $user->id) }}
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('first_name', 'Fornavn: ') }} </label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::text('first_name', $user->first_name, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>
    
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('last_name', 'Etternavn: ') }} </label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::text('last_name', $user->last_name, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>
    
            <br>
    
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('uname', 'Brukernavn: ') }} </label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::text('uname', $user->user_name, array('disabled', 'class' => 'form-control')) }}
                        </div>
                            {{ Form::hidden('user_name', $user->user_name) }}
                        </div>
                    </div>
            </div>
        
            <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-6 control-label pull right">{{ Form::label('email', 'E-post: ') }} </label>
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('email', $user->email, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>
    
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('password', 'Nytt Passord: ') }} </label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('conf_password', 'Bekreft Passord: ') }}</label>
                        </div>
                        <div class="col-md-5">
                            {{ Form::password('conf_password', array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>
   
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('user_type', 'Brukertype (user/admin) : ') }}</label>
                        </div>
                        <div class="col-md-5">    
                            {{ Form::select('user_type', array('user' => 'user', 'admin' => 'admin'), $user->user_type , array('class' => 'form-control')) }} 
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">    
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        {{ Form::submit('Oppdater bruker', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </div>
            
            <br>

        </div>
    </div>
</div>

@stop