<!--
    The index page / root page for the webapp,
    here the users can log in to access the features
    and functionality of the application.

    Errors upon logging in will get snapped up and
    the users will be redirected here with the errors.
    This also happens if users try to bypass this page
    by typing in the url directly without being logged in.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>{{ $title }}</title>

        <!-- Bootstrap core CSS -->
        <link type="text/css" rel="stylesheet" href="{{ URL::to('css/bootstrap.css') }}"> 
    </head>

    <body>
       <div class="container">    
            <div style="text-align: center"> 
            <img src="../public/images/nih.png" alt="BassengWeb" width="400" </img></div>
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Logg inn</div>
                    </div>     
               
                    <div style="padding-top:30px" class="panel-body" >
                
                        @if(Session::has('error')) <!-- Handles general error messages -->
                            <div class="alert alert-danger">
                           <div id="svart"> {{ Session::get('error') }}</div>
                            </div>
                        @endif
                        
                       
                        @if($errors->has()) <!-- Handles the validation errors from the login form -->
                            <div class="alert alert-danger">
                            
								
							<div id="svart">   								
								
									{{ $errors->first('username', '<li>:message</li>') }} 
                                    {{ $errors->first('password', '<li>:message</li>') }}
								</div>
							      
								
                            </div>
                        @endif
                        
                        
                       
                        @if(Session::has('message')) <!-- Handles success messages -->
                        <div class="alert alert-success">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                       @endif 
                        
                       
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        {{ Form::open(array('url' => 'bassengweb/login', 'method' => 'POST', 'class' => 'form-horizontal')) }} <!-- Login form -->
                   
                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            {{ Form::text('username', null, array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'Brukernavn')) }}           
                        </div>
                            
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Passord')) }}
                       </div>
                                                
                        <div id="logginn" class="form-group">
                            <!-- Button -->

                            <div class="col-md-12 controls">
                                {{ Form::submit('Logg inn', array('class' => 'btn btn-success')) }}
                            </div>
                        </div>
        
                        {{ Form::close() }}

                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>