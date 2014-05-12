@extends('default')
@section('content')
<!-- This is the content of the view file timemaling which contains the forms  -->
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
					<br>
					<h2><span class="glyphicon glyphicon-time"></span> Timemåling</h2>
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
					 @foreach ($errors->all() as $errors)
					<div class="alert alert-danger"> 
						<div id="svart"><li>{{ $errors }}</li> </div>
					</div>
					@endforeach
						
							

				</div>

			</div>
			   
			{{ Form::open(array('url' => 'bassengweb/insertTM', 'method' => 'POST', 'class' => 'form-horizontal')) }}

				<div class="form-group">
					<label  class="col-md-5 control-label">Tid: </label>
					<div class="col-md-7">	
						{{ Form::text('Time', $time, array('class' => 'form-control')) }}
					</div>
				</div>
 
				<div class="form-group">
				<label  class="col-md-5 control-label">Basseng: </label>
					<div class="col-md-7">
						{{ Form::select('pool_id', $pools, Input::old('pool_id'), array('class' => 'form-control')) }} 
					</div>
				</div>
				 
				<div class="form-group">
				<label  class="col-md-7 control-label">Badende Per Time: </label>
				<div class="col-md-5" >
					{{ Form::text('T_Badende_per_Time', Input::old('T_Badende_per_Time'), array('class' => 'form-control'))  }}  
				</div>
				</div>
			 
				<div class="form-group">
				<label  class="col-md-7 control-label">Temperatur: </label>
					<div class="col-md-5">
						{{ Form::text('T_Temperatur', Input::old('T_Temperatur'), array('class' => 'form-control' )) }}  
					</div>
				</div>
			 
				<div class="form-group">
					<div class="col-md-offset-6 col-md-5">
						{{ Form::submit('Lagre Basseng måling', array('class' => 'btn btn-primary')) }}
					</div>
				</div>
				 {{ Form::close() }}

			<!-- This is the right side form  -->	 
			<div id="form-horizontal"> 
					
				{{ Form::open(array('url' => 'bassengweb/insertTM', 'method' => 'POST', 'class' => 'form-horizontal')) }}
					   
					<div class="form-group">
					   
						<label  class="col-md-7 control-label">Tid: </label>
						<div class="col-md-5">
						 {{ Form::text('Time', $time, array('class' => 'form-control')) }}
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-md-7 control-label">Basseng: </label>
						<div class="col-md-5">
							{{ Form::text('displayPool', $pools[99], array('disabled', 'class' => 'form-control' )) }}  	
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-md-7 control-label">Luft-Temperatur: </label>
						<div class="col-md-5">
							{{ Form::text('T_Luft_Temperatur', Input::old('T_Luft_Temperatur'), array('class' => 'form-control' )) }}  	
						</div>
					</div>
					 
					{{ Form::hidden('pool_id', 99) }}
							

					<div class="form-group">
						<div class="col-md-offset-7 col-md-7">
						   {{ Form::submit('Lagre Luft-måling', array('class' => 'btn btn-primary')) }}
						</div>
					</div>
					
					{{ Form::close() }}

			</div>
				<hr> <!-- Gets input from the DB about the last ten measurements done, and prints them -->
				   @if(isset($tenLast))
				   <table class='table table-hover'>
				   	<tr class='active'>
						<td>ID</td>
				   		<td>Tid</td>
				   		<td>Tittel</td>
				   		<td>Verdi</td>
				   		<td>Basseng</td>
				   		<td>Ansatt</td>
				   	</tr>
				   	@foreach ($tenLast as $tenDone)
				   	<tr>
				   		@foreach($tenDone->measurements as $measurements)
						<td>{{ $tenDone->id }}</td>
				   		<td>{{ $tenDone->time }}</td>
				  		<td>{{ $measurements->title }}</td>
				  		@endforeach
				   		<td>{{ $tenDone->value }}</td>
				   		@foreach($tenDone->measurements as $measurements)
				   		<td>{{ $pools[$measurements->pivot->pool_id] }}</td>
				   		@endforeach
				   		<td>{{ $tenDone->emps->user_name }}</td>
				   	</tr>
				   	@endforeach
				   </table>
				   @endif	
		</div>
    </div>

@stop