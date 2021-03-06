@extends('default')
@section('content')
 <!-- This is the content of the view file helgevakt which contains the forms  -->	
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<br>
					<h2><span class="glyphicon glyphicon-check"></span> Helgevakt </h2>
					<hr>
						<!-- Handling success messages  -->		
						<div id="response" > 
							@if(Session::has('message'))
							<div class="alert alert-success">
								<p>{{ Session::get('message') }}</p>
							</div>
						</div>
						   @endif
				</div>
    
				<div class="row">
				
					{{ Form::open(array('url' => 'bassengweb/insertHV', 'method' => 'POST', 'class' => 'form-inline')) }}
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
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Slamsuge_Pl_Bass', 'Slamsuge pl. bass:') }} </label>
							<div class="col-md-6 col-lg-6">
								 @if(in_array('H_Slamsuge_Pl_Bass', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Slamsuge_Pl_Bass', 'Utført')  }}   
								@endif
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vannprov_Reg_1400', 'Vannprøver/registrering Kl 14.00:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Vannprov_Reg_1400', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vannprov_Reg_1400', 'Utført')  }}   
								@endif
							</div>
						</div>
		
					</div>
				</div>
	
				<hr>
        
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vaske_Kortkanter', 'Vaske kortkanter i begge bass:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Vaske_Kortkanter', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vaske_Kortkanter', 'Utført')  }}   
								@endif
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vannprov_Reg_1700', 'Vannprøver/registrering Kl 17.00:') }} </label>
							<div class="col-md-6 col-lg-6">
							   @if(in_array('H_Vannprov_Reg_1700', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vannprov_Reg_1700', 'Utført')  }}   
								@endif  
							</div>
						</div>
				   </div>
      
				</div>
				
				<hr>
        
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vaske_Gulv_CM', 'Vaske gulv m/ CM:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Vaske_Gulv_CM', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vaske_Gulv_CM', 'Utført')  }}   
								@endif    
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Sjekke_Syreflow', 'Sjekke syreflow:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Sjekke_Syreflow', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Sjekke_Syreflow', 'Utført')  }}   
								@endif      
							</div>
						</div>
					</div> 
					
				</div>
				
				<hr>
        
				<div class="row">
			  
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Runde_Gard_Morgen', 'Runde garderober åpne dør til tribune Morgen Kl 08.00 "5A+kort+kode":') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Runde_Gard_Morgen', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
								  {{ Form::checkbox('H_Runde_Gard_Morgen', 'Utført')  }}   
								@endif       
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Sjekke_klorfat_Syrekanner_flockmiddel_Kalsiumklorid', 'Sjekke nivå klorfat, syrekanner, flockmidddel, kalsiumklorid:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Sjekke_klorfat_Syrekanner_flockmiddel_Kalsiumklorid', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
								  {{ Form::checkbox('H_Sjekke_klorfat_Syrekanner_flockmiddel_Kalsiumklorid', 'Utført')  }}   
								@endif    
							</div>
						</div>
					</div>
				 
				</div>
        
				<hr>
				
				<div class="row">
		 
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Runde_Gard_Midt_Dag', 'Runde garderober åpne dør til tribune Midt  på dagen "5A+kort+kode":') }} </label>
							<div class="col-md-6 col-lg-6">
							 @if(in_array('H_Runde_Gard_Midt_Dag', $done))
								<span class='glyphicon glyphicon-ok'></span>
							@else
							  {{ Form::checkbox('H_Runde_Gard_Midt_Dag', 'Utført')  }}   
							@endif    
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Tomme_Soppel_Pose', 'Tømme søppel WC og ny pose (før du går):') }} </label>
							<div class="col-md-6 col-lg-6">
							   @if(in_array('H_Tomme_Soppel_Pose', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Tomme_Soppel_Pose', 'Utført')  }}   
								@endif    
							</div>
						</div>
					</div>
			   
				</div>
				
				<hr>
        
				<div class="row">
		
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Male_Temp_Just', 'Måle temp. + just.:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Male_Temp_Just', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Male_Temp_Just', 'Utført')  }}   
								@endif     
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Enkle_Vedlikholds_Oppg', 'Enkle vedlikeholdsoppgaver tas straks:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Enkle_Vedlikholds_Oppg', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
								  {{ Form::checkbox('H_Enkle_Vedlikholds_Oppg', 'Utført')  }}   
								@endif    
							</div>
						</div>
				   </div>
    
				</div>
        
				<hr>
        
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Ettersyn_Utstyr_Skap', 'Ettersyn utstyr/skap:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Ettersyn_Utstyr_Skap', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Ettersyn_Utstyr_Skap', 'Utført')  }}   
								@endif     
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Skap_lases', 'Skap låses:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Skap_lases', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Skap_lases', 'Utført')  }}   
								@endif    
							</div>
						</div>	
					</div>
					
				</div>
				
				<hr>
        
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Handicap_Heis', 'Handicap Heis:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('H_Handicap_Heis', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('H_Handicap_Heis', 'Utført')  }}   
									@endif     
								</div>
							</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Rydde_Tribune_Soppel', 'Rydde tribune for søppel etc:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Rydde_Tribune_Soppel', $done))
										<span class='glyphicon glyphicon-ok'></span>
								@else
								  {{ Form::checkbox('H_Rydde_Tribune_Soppel', 'Utført')  }}   
								@endif    
							</div>
						</div>
					</div>
				</div>
        
				<hr>
        
				<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Ettersyn_Solarier_X2', 'Ettersyn solarier X 2:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('H_Ettersyn_Solarier_X2', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('H_Ettersyn_Solarier_X2', 'Utført')  }}   
									@endif      
								</div>
							</div>
						</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Sette_Slamsugeren_H_Bass', 'Sette ut slamsugeren i h.bass:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('H_Sette_Slamsugeren_H_Bass', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('H_Sette_Slamsugeren_H_Bass', 'Utført')  }}   
									@endif    
								</div>
						</div>
		
					</div>
				</div>
				
				<hr>
        
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vannprov_Reg_0830', 'Vannprøver/registrering Kl 08.30:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Vannprov_Reg_0830', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vannprov_Reg_0830', 'Utført')  }}   
								@endif 
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Slukke_lys_Stenge_lase_dor', 'Slukke lys + stenge dusjer/dører + låse dør til tribune "5A+kort+kode":') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Slukke_lys_Stenge_lase_dor', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Slukke_lys_Stenge_lase_dor', 'Utført')  }}   
								@endif   
							</div>
						</div>
					</div>
					
				</div>
        
				<hr>
        
        
				<div class="row">
		
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Vannprov_Reg_1100', 'Vannprøver/registrering Kl 11.00:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Vannprov_Reg_1100', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Vannprov_Reg_1100', 'Utført')  }}   
								@endif    
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('H_Beskjed_H_vakta', 'Gi beskjed til h.vakta om at du går for dagen:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('H_Beskjed_H_vakta', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('H_Beskjed_H_vakta', 'Utført')  }}   
								@endif  
							</div>
						</div>	
					</div>
				</div>
        
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