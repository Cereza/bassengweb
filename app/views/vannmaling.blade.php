@extends('default')
@section('content')
      <!-- This is the content of the view file vannmaling which contains the forms  -->
	<div class="jumbotron">	
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<br>
					<h2><span class="glyphicon glyphicon-tint"></span> Vannmåling </h2>
					<hr>
					<!-- Handling success messages  -->
					<div id="response" > 
					@if(Session::has('message'))
						<div class="alert alert-success">
							<p>{{ Session::get('message') }}</p>
						</div>
					</div>
					@endif
					
					<!-- Handling error messages  -->   
					@if($errors->has())
					<div class="alert alert-danger">  
						<div id="svart">    
							{{ $errors->first('M_Fritt_Klor', '<li>:message</li>') }}
							{{ $errors->first('M_Bundet_Klor', '<li>:message</li>') }}
							{{ $errors->first('M_Total_Klor', '<li>:message</li>') }}
							{{ $errors->first('M_PH', '<li>:message</li>') }}
							{{ $errors->first('M_Auto_Klor', '<li>:message</li>') }}
							{{ $errors->first('M_Auto_PH', '<li>:message</li>') }}
							{{ $errors->first('M_Redox', '<li>:message</li>') }}
						</div>
					</div>
					@endif  
					
					
					
				</div>
			  
				<div class="venstre">
					
					{{ Form::open(array('url' => 'bassengweb/insertVM', 'method' => 'POST', 'class' => 'form-horizontal')) }}
				
					<div class="form-group">
						<label  class="col-md-5 control-label">Basseng: </label>
							<div class="col-md-7">
								{{ Form::select('pool_id', $pools, Input::old('pool_id'), array('class' => 'form-control' )) }} 
							</div>
						</div>
	 
					<div class="form-group">
						<label  class="col-md-5 control-label">Tid: </label>
						<div class="col-md-7">
							{{ Form::text('Time', $time, array('class' => 'form-control')) }}
						</div>
					</div> 
					  
					<hr>

					<div class="form-group">
					<label  class="col-md-7 control-label">Fritt klor: </label>
						<div class="col-md-5" >
							{{ Form::text('M_Fritt_Klor', Input::old('M_Fritt_Klor'), array('class' => 'form-control'))  }}  
						</div>
					</div>
				 
					<div class="form-group">
					<label  class="col-md-7 control-label">Total Klor: </label>
						<div class="col-md-5">
							{{ Form::text('M_Total_Klor', Input::old('M_Total_Klor'), array('class' => 'form-control' )) }}  
						</div>
					</div>   
						
					<div class="form-group">
					<label  class="col-md-7 control-label">Bundet Klor: </label>
						<div class="col-md-5">
							{{ Form::text('M_Bundet_Klor', Input::old('M_Bundet_Klor'), array('class' => 'form-control' )) }}  
						</div>
					</div>
					 
					<div class="form-group">
					<label  class="col-md-7 control-label">PH: </label>
						<div class="col-md-5">
							{{ Form::text('M_PH', Input::old('M_PH'), array('class' => 'form-control' )) }}  
						</div>
					</div>  
				 
				</div>
				
				<div class="form-horizontal">

					<div class="form-group">
					<label  class="col-md-7 control-label">Automatikk - Klor: </label>
						<div class="col-md-5">
						{{ Form::text('M_Auto_Klor', Input::old('M_Auto_Klor'), array('class' => 'form-control' )) }}  
						</div>
					</div> 
				
					<div class="form-group">
					<label  class="col-md-7 control-label">Automatikk - PH: </label>
						<div class="col-md-5">
							{{ Form::text('M_Auto_PH', Input::old('M_Auto_PH'), array('class' => 'form-control' )) }}  
						</div>
					</div> 

					<div class="form-group">
					<label  class="col-md-7 control-label">Redox: </label>
						<div class="col-md-5">
							{{ Form::text('M_Redox', Input::old('M_Redox'), array('class' => 'form-control' )) }}  
						</div>
					</div> 
				
					<div class="form-group">
						<div class="col-md-offset-8 col-md-5">
							{{ Form::submit('Lagre', array('class' => 'btn btn-primary btn-lg')) }}
						</div>
					</div>
				 
				  {{ Form::close() }}

				</div>
			   
			</div> 
		</div>
	</div>
@stop