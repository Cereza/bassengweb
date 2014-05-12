@extends('default')
@section('content')
 <!-- This is the content of the view file kontrollcm which contains the forms  -->	
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<br>
					<h2><span class="glyphicon glyphicon-time"></span> Vask med CM </h2>
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
								{{ $errors->first('C_Timeteller', '<li>:message</li>') }}
							</div>
						</div>		 
					@endif
    
    
				</div>
    
    
				<div class="row">
				
					{{ Form::open(array('url' => 'bassengweb/insertKCM', 'method' => 'POST', 'class' => 'form-inline')) }}
					
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-3 control-label">Dato: </label>
							<div class="col-md-6 col-lg-6">
								{{ Form::text('Date', $date, array('class' => 'form-control')) }}
							</div>
						</div>
					  </div>
  
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
						  <label class="col-md-3 control-label">Tid: </label>
							<div class="col-md-6 col-lg-6">
								{{ Form::text('Time', $time, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
				</div>
  
				<hr>
    
				<div class="row">
				
				  <div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Timeteller', 'Timeteller:') }} </label>
						  <div class="col-md-6 col-lg-6">
							@if(in_array('C_Timeteller', $done))
								<span class='glyphicon glyphicon-ok'></span>
							@else  
								{{ Form::text('C_Timeteller', Input::old('C_Timeteller'), array('class' => 'form-control' )) }}  
							@endif   
						  </div>
						</div>
				  </div>
						
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Ren_Opplos_Filter', 'Rengjøre oppløsningsfilteret (Tir):') }} </label>
							@if ($day==='Tuesday')  
								@if(in_array('C_Ren_Opplos_Filter', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else  
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('C_Ren_Opplos_Filter', 'Utført') }}  
									</div>
								@endif 
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif
						</div>
					 </div>
				</div>
  
				<hr>
				
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_AllRent', 'Allrent:') }} </label>
							<div class="col-md-6 col-lg-6">
							   @if(in_array('C_AllRent', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('C_AllRent', 'Utført')  }}   
							  @endif   
							</div>
						</div>
					</div>
					 
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Ren_Nal', 'Rengjøre Nal (Tir):') }} </label> 
							@if ($day==='Tuesday')  
								@if(in_array('C_Ren_Nal', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('C_Ren_Nal', 'Utført')  }}  
									</div>
								@endif 
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif
						</div>
					</div>   
					 
				</div>
			
				<hr>
    
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Grovrent_Ekstra', 'Grovent Ekstra:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('C_Grovrent_Ekstra', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('C_Grovrent_Ekstra', 'Utført')  }}   
								@endif   
						  </div>
						</div>
					</div>
					 
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Kontr_Slang_Tank', 'Kontroller slanger og tank (Tir):') }} </label>
							@if ($day==='Tuesday')							
								@if(in_array('C_Kontr_Slang_Tank', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('C_Kontr_Slang_Tank', 'Utført')  }}  
									</div>
								@endif 
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif
						</div>
					</div>		   
				</div>
				
				<hr>
    
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Ren_Opplos_Tank', 'Rengjøre Oppløsningstank:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('C_Ren_Opplos_Tank', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('C_Ren_Opplos_Tank', 'Utført')  }}   
								@endif    
								</div>
						</div>
					</div>
			 
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Kont_Ren_KostPad', 'Kontroller og rengjør kost/pad og padholder (Tir):') }} </label>
							<div class="col-md-6 col-lg-6">
								@if ($day==='Tuesday')  
									@if(in_array('C_Kont_Ren_KostPad', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else 
										<div class="col-md-6 col-lg-6">
											{{ Form::checkbox('C_Kont_Ren_KostPad', 'Utført')  }}  
										</div>
									@endif 
								@else
									<span class='glyphicon glyphicon-remove'></span>
								@endif 
							</div>	
						 </div>	  
					</div>
				</div>
				
				<hr>
    
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Ren_Opps_Tank', 'Rengjøre Oppsamlingstank:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('C_Ren_Opps_Tank', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('C_Ren_Opps_Tank', 'Utført')  }}   
								@endif  
							</div>
						</div>
					</div>  
				</div>
				
				<hr>
    

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('C_Ren_Flott_gitter', 'Rengjøre Flottørgitter:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('C_Ren_Flott_gitter', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('C_Ren_Flott_gitter', 'Utført')  }}   
								@endif  
							</div>
						</div>
					</div>
				</div>
				
				<hr>
			
				<div class="well md">
					<div class="form-group">
						<div class="col-md-offset-5 col-md-5">
							{{ Form::submit('Lagre', array('class' => 'btn btn-primary btn-lg')) }}
						</div>
					</div><br>
				</div>

				{{ Form::close() }}
				
			</div>
        </div>
    </div>
@stop