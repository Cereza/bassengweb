@extends('default')
@section('content')
  <!-- This is the content of the view file oppgaver which contains the forms  -->
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<br>
					<h2><span class="glyphicon glyphicon-edit"></span> Daglige oppgaver </h2>
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
								{{ $errors->first('O_Vannbalanse', '<li>:message</li>') }}
								{{ $errors->first('O_Alakalitet', '<li>:message</li>') }}
								{{ $errors->first('O_Hardhet', '<li>:message</li>') }}
								{{ $errors->first('O_Natrium_Bk', '<li>:message</li>') }}
								{{ $errors->first('O_Sjokklor', '<li>:message</li>') }}
								{{ $errors->first('O_Sirkulasjonsmengde', '<li>:message</li>') }}
								{{ $errors->first('O_Filtertrykk', '<li>:message</li>') }}
								{{ $errors->first('O_Vannforbruk', '<li>:message</li>') }}
								{{ $errors->first('O_Kals_Klor', '<li>:message</li>') }}
						   </div>
						</div>
					@endif  

				</div>

				{{ Form::open(array('url' => 'bassengweb/insertOP', 'method' => 'POST', 'class' => 'form-horizontal')) }}
			
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

				<div class="form-group">
				<label  class="col-md-5 control-label">Dato: </label>
					<div class="col-md-7">
						{{ Form::text('Date', $date, array('class' => 'form-control')) }}
					</div>
				</div> 
			
				<br>

				<div id="center"> <br> <h3> Gjøremål: </h3> <hr> </div>
			 
				<div class="form-group">
				<label  class="col-md-7 control-label">Vannbalanse: </label>
					<div class="col-md-5" >
						{{ Form::text('O_Vannbalanse', Input::old('O_Vannbalanse'), array('class' => 'form-control' ))  }}  
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Alakalitet: </label>
					<div class="col-md-5" >					
						{{ Form::text('O_Alakalitet', Input::old('O_Alakalitet'), array('class' => 'form-control' ))  }} 
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Hardhet: </label>
					<div class="col-md-5" >
						{{ Form::text('O_Hardhet', Input::old('O_Hardhet'), array('class' => 'form-control' ))  }}  
					</div>
				</div>
			 
				<div id="center"> <br> <h3> Tilsats av kjemikalier </h3> <hr> </div>
			 
				<div class="form-group">
				<label  class="col-md-7 control-label">Natriumbikarbonat: </label>
					<div class="col-md-5" >
						 {{ Form::text('O_Natrium_Bk', Input::old('O_Natrium_Bk'), array('class' => 'form-control' ))  }}    
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">{{ Form::label('O_Kals_Klor[]', 'Kalsiumklorid (enten utført eller verdi):') }} </label>
					<div class="col-md-5" >
						{{ Form::text('O_Kals_Klor[1]', Input::old('O_Kals_Klor[1]'), array('class' => 'form-control' ))  }}  
						{{ Form::checkbox('O_Kals_Klor[0]', 'Utført')  }}  
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Sjokkloring/Klor tilsatt: </label>
					<div class="col-md-5" >
						{{ Form::text('O_Sjokklor', Input::old('O_Sjokklor'), array('class' => 'form-control' ))  }}      
					</div>
				</div>
			
				<div class="form-group">
				<label class="col-md-7 control-label">  {{ Form::label('O_Fellingsmiddel', 'Fellingsmiddel:') }} </label>
					<div class="col-md-5" >
						 {{ Form::checkbox('O_Fellingsmiddel', 'Utført') }}    
					</div>
				</div>
			 

				<div id="center"> <div id="br"> <br> </div> <h3> Sirkulasjon/filtrering </h3> <hr> </div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Sirkulasjonsmengde: </label>
					<div class="col-md-5" >
						{{ Form::text('O_Sirkulasjonsmengde', Input::old('O_Sirkulasjonsmengde'), array('class' => 'form-control' ))  }}  
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Filtertrykk: </label>
					<div class="col-md-5" >
						
						{{ Form::text('O_Filtertrykk', Input::old('O_Filtertrykk'), array('class' => 'form-control' ))  }} 
						
					</div>
				</div>
			
				<div class="form-group">
				<label class="col-md-7 control-label">  {{ Form::label('O_Spyl_Av_Filter', 'Spyling av filter:') }} </label>
					<div class="col-md-5" >
						
							 {{ Form::checkbox('O_Spyl_Av_Filter', 'Utført') }} 
					</div>
				</div>
			
				<div class="form-group">
				<label  class="col-md-7 control-label">Vannforbruk: </label>
					<div class="col-md-5" >
						
							 {{ Form::text('O_Vannforbruk', Input::old('O_Vannforbruk'), array('class' => 'form-control' ))  }} 
				
					</div>
				</div>
			
				<div class="form-group">
				<label class="col-md-7 control-label">  {{ Form::label('O_Slamsuging', 'Slamsuging:') }} </label>
					<div class="col-md-5" >
						
							{{ Form::checkbox('O_Slamsuging', 'Utført') }}
						
					 
					</div>
				</div>
			
				<div class="form-group">
				<label class="col-md-7 control-label">  {{ Form::label('O_Harsil', 'Hårsil:') }} </label>
					<div class="col-md-5" >
						
							{{ Form::checkbox('O_Harsil', 'Utført') }} 
						
						
					</div>
				</div>
			
				<div class="form-group">
				<label class="col-md-7 control-label">  {{ Form::label('O_Ren_Utj_Tank', 'Rengjøring av Utj. Tank:') }} </label>
					<div class="col-md-5" >
						
							 {{ Form::checkbox('O_Ren_Utj_Tank', 'Utført') }} 
						
					
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
@stop