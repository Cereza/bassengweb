@extends('default')

@section('content')

<!--
    The view file for creating a new user to be stored in the DB.
    Also shows flash messages for errors and validation errors.
    Old input is reflashed into the form boxes upon errors.
-->

<br>
	
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
 
                <br>

                <h2><span class="glyphicon glyphicon-cog"></span> {{ $title }}</h2>
                
                <hr>
        
                @if(Session::has('message'))
                    <p style="color: green;">{{ Session::get('message') }}</p>
                @endif

                <div id="response" > 

                    @if($errors->has()) <!-- Handles validation error messages -->
                        <div class="alert alert-danger">  
                            @foreach ($errors->all() as $errors)
                                <div id="svart"><li>{{ $errors }}</li> </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                {{ Form::open(array('url' => 'bassengweb/spawn_user', 'method' => 'POST', 'autocomplete' => 'off')) }} <!-- The form for user creation -->
                <div class="col-md-8">
				    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('first_name', 'Fornavn: ') }} </label>
                        </div>
                        <div class="col-md-4">
                            {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
                        </div>
				    </div>
                </div>
            </div>
    
            <br>

            <div class="row">
                <div class="col-md-8">
    				<div class="form-group">
                        <div id="center-right">
    					   <label class="col-md-7 control-label pull right">{{ Form::label('last_name', 'Etternavn: ') }} </label>
                        </div>
    					<div class="col-md-4">
                            {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control' )) }}
    					</div>
    				</div>
    			</div>
            </div>

            <br>
     
            <div class="row">	
                <div class="col-md-8">
				    <div class="form-group">
                        <div id="center-right">
                            <label class="col-md-7 control-label pull right">{{ Form::label('email', 'E-post : ') }}</label>
                        </div>
					    <div class="col-md-5">
                       	    {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
					    </div>
                    </div>
                </div>
            </div>
    
            <br>
    
            <div class="row">    
                <div class="col-md-8">
                    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('user_type', 'Brukertype: ') }}</label>
                        </div>
					    <div class="col-md-4">
                            {{ Form::select('user_type', array('user' => 'user', 'admin' => 'admin'), 'user', array('class' => 'form-control')) }}
					    </div>
				    </div>
                </div>
            </div>
    
	        <br>
    
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <div id="center-right">
					       <label class="col-md-7 control-label pull right">{{ Form::label('password', 'Passord : ') }}</label>
                        </div>
					    <div class="col-md-4">
                            {{ Form::password('password', array('class' => 'form-control')) }}
					    </div>
				    </div>
                </div>
            </div>
    
            <br>
    
            <div class="row">
                <div class="col-md-8">
                   <div class="form-group">
                        <div id="center-right">
			         		<label class="col-md-7 control-label pull right">{{ Form::label('password_confirmation', 'Bekreft Passord : ') }}</label>
                        </div>
					    <div class="col-md-4">
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
					    </div>
				    </div>
                </div>
            </div>
		
            <br>
    
            <div class="row">
                <div class="form-group">
                    <div class="col-md-offset-5 col-md-5">
                        {{ Form::submit('Opprett bruker', array('class' => 'btn btn-primary')) }}
                    </div>
                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop