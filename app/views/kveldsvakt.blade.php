@extends('default')
@section('content')
 <!-- This is the content of the view file kveldsvakt which contains the forms  -->
	<div class="jumbotron" >
		<div class="container" >
			<div class="row" >
				<div class="col-lg-12" >

					<br>
					<h2><span class="glyphicon glyphicon-check"></span> Kveldsvakt </h2>
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
				
					{{ Form::open(array('url' => 'bassengweb/insertKV', 'method' => 'POST', 'class' => 'form-inline')) }}
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
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Oppdatere_Seg_IkkeUtf', 'Oppdatere seg på ikke utf. oppgaver:') }} </label>
							<div class="col-md-6 col-lg-6">
							 <!-- If the task is done it will show the ok icon, if not it will show the checkbox  -->
								@if(in_array('K_Oppdatere_Seg_IkkeUtf', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Oppdatere_Seg_IkkeUtf', 'Utført')  }}  
								@endif
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Ettersyn_Sal_4', 'Ettersyn av Sal 4:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Ettersyn_Sal_4', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Ettersyn_Sal_4', 'Utført')  }}  
								@endif
							</div>
						</div>
					</div>
				</div>
			
				<hr>
		 
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Forrige_Uke_Badende', 'Telle opp forrige ukes badende (Man):') }} </label> 
								@if ($day==='Monday')
									@if(in_array('K_Forrige_Uke_Badende', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										<div class="col-md-6 col-lg-6">
											{{ Form::checkbox('K_Forrige_Uke_Badende', 'Utført')  }} 
										</div>
									@endif
								@else
									<span class='glyphicon glyphicon-remove'></span>
								@endif
						</div>
					</div>
					
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_RundeGard_2_Ganger', 'Runde garderober minst 2 ganger per vakt') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_RundeGard_2_Ganger', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_RundeGard_2_Ganger', 'Utført')  }}  
								@endif
							</div>
						</div>
				
					</div>
				</div>
			
				<hr>
		 
				<div class="row">
				
					<div class="col-md-6">
					<div class="form-group">
					  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Vannprover_1700', 'Vannprøver/registrering Kl 17.00:') }} </label>
					  <div class="col-md-6 col-lg-6">
					   @if(in_array('K_Vannprover_1700', $done))
									<span class='glyphicon glyphicon-ok'></span>
						@else
						{{ Form::checkbox('K_Vannprover_1700', 'Utført')  }}  
									@endif
					  </div>
					</div>
				  </div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Enkle_Vedlik_Oppg', 'Enkle vedlikeholdsoppgaver tas straks:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Enkle_Vedlik_Oppg', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Enkle_Vedlik_Oppg', 'Utført')  }}  
								@endif  
							</div>
						</div>
					</div>
					
				</div>
			
				<hr>
			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Vannprover_2000', 'Vannprøver/registrering Kl 20.00:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('K_Vannprover_2000', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('K_Vannprover_2000', 'Utført')  }}  
									@endif   
								</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Rullestolheis_lading', 'Sjekk at rollestolheis står nede og til lading:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Rullestolheis_lading', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Rullestolheis_lading', 'Utført')  }}  
								@endif     
							</div>
						</div>
					</div>
				</div>
			
				<hr>
		 
				<div class="row">
				  
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_klorfat_Syrekanner_Flockmiddel_Kalsklorid','Sjekk nivå Klorfat, syrekanner, flockmiddel, kalsiumklorid') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_klorfat_Syrekanner_Flockmiddel_Kalsklorid', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_klorfat_Syrekanner_Flockmiddel_Kalsklorid', 'Utført')  }}  
								@endif       
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Etterfylle_Skoposer', 'Etterfylle Skoposer:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('K_Etterfylle_Skoposer', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('K_Etterfylle_Skoposer', 'Utført')  }}  
									@endif       
								</div>
						</div>
					</div>
					
				</div>
			
				<hr>
			
				<div class="row">
				  
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Sjekk_syreflow','Sjekk syreflow') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Sjekk_syreflow', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Sjekk_syreflow', 'Utført')  }}  
								@endif      
							</div>
						</div>
					</div>
			
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Skap_Lases', 'Skap Låses:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Skap_Lases', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Skap_Lases', 'Utført')  }}  
								@endif  
							</div>
						</div>
					</div>
				</div>
			
				<hr>
			
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Sla_Av_Bypass','Slå av Bypass (Man og Ons):') }} </label>
							@if ($day==='Monday' || $day==='Wednesday')
								@if(in_array('K_Sla_Av_Bypass', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('K_Sla_Av_Bypass', 'Utført')  }}
									</div>
								@endif
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif
						</div>
					</div> 
				
				
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Sjekk_Skiftplan', 'Sjekk Skiftplan') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Sjekk_Skiftplan', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Sjekk_Skiftplan', 'Utført')  }}  
								@endif   
							</div>
						</div>
					</div>
				</div>
			
				<hr>
			
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Kontroll_Wc','Kontroll av WC:') }} </label>
						  <div class="col-md-6 col-lg-6">
							@if(in_array('K_Kontroll_Wc', $done))
								<span class='glyphicon glyphicon-ok'></span>
							@else
								{{ Form::checkbox('K_Kontroll_Wc', 'Utført')  }}  
							@endif   
						  </div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Rydd_Tribune', 'Tribune ryddes for søppel:') }} </label>
						  <div class="col-md-6 col-lg-6">
							@if(in_array('K_Rydd_Tribune', $done))
										<span class='glyphicon glyphicon-ok'></span>
							@else
								{{ Form::checkbox('K_Rydd_Tribune', 'Utført')  }}  
							@endif    
						  </div>
						</div>
					</div>
				</div>
			
				<hr>
		 
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Ettersyn_Materiell','Ettersyn av Materiell:') }} </label>
							  <div class="col-md-6 col-lg-6">
								@if(in_array('K_Ettersyn_Materiell', $done))
											<span class='glyphicon glyphicon-ok'></span>
								@else
								{{ Form::checkbox('K_Ettersyn_Materiell', 'Utført')  }}  
											@endif     
							  </div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
					  <div class="form-group">
						<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Slamsug_H_Bass', 'Sette ut slamsugeren i H.Bass:') }} </label>
						  <div class="col-md-6 col-lg-6">
							@if(in_array('K_Slamsug_H_Bass', $done))
								<span class='glyphicon glyphicon-ok'></span>
							@else
								{{ Form::checkbox('K_Slamsug_H_Bass', 'Utført')  }}  
							@endif    
						  </div>
						</div>
					</div>
				</div>
			
				<hr>
			
				<div class="row">
			  
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Ettersyn_Solarier','Ettersyn av Solarier x2:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Ettersyn_Solarier', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Ettersyn_Solarier', 'Utført')  }}  
								@endif     
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Soppel_WC', 'Tømme søppel på WC:') }} </label>
							<div class="col-md-6 col-lg-6">
								 @if(in_array('K_Soppel_WC', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Soppel_WC', 'Utført')  }}  
								@endif      
						  </div>
						</div>
					 </div>
				</div>
			
				<hr>
			
				<div class="row">
			 
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Stenge_Prosedyre','Slukke lys, stenge dusj/dører, låse dør til tribune "5A+Kort+Kode":') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Stenge_Prosedyre', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Stenge_Prosedyre', 'Utført')  }}  
								@endif    
							</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('K_Beskjed_H_Vakt', 'Gi beskjed til h.vakta om at du går for dagen:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('K_Beskjed_H_Vakt', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('K_Beskjed_H_Vakt', 'Utført')  }}  
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