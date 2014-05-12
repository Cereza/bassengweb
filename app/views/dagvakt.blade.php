@extends('default')
@section('content')
 <!-- This is the content of the view file dagvakt which contains the forms  -->
	<div class="jumbotron" >
		<div class="container" >
			<div class="row" >
				<div class="col-lg-12" >
						
					<br>
					<h2><span class="glyphicon glyphicon-check"></span> Dagvakt </h2>
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
					{{ Form::open(array('url' => 'bassengweb/insertDV', 'method' => 'POST', 'class' => 'form-inline')) }}
					
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
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Slamsuge_Pl_Bass', 'Slamsuge pl. Bass:') }} </label>
							  <div class="col-md-6 col-lg-6">
							  <!-- If the task is done it will show the ok icon, if not it will show the checkbox  -->
								@if(in_array('D_Slamsuge_Pl_Bass', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Slamsuge_Pl_Bass', 'Utført')  }}
								@endif
							  </div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vaske_H_Bass', 'Vaske kanter H. Basseng (Man, Fre og Søn):') }} </label>
							<!-- if the day is one of those the checkbox will be shown if not it will show X icon. If it is one of those days the checkbox will be shown if not the task have not been done earlier   -->
							@if ($day==='Monday' || $day==='Friday' || $day==='Sunday')
								@if(in_array('D_Vaske_H_Bass', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else 
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('D_Vaske_H_Bass', 'Utført') }} 
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
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vannmengde_08', 'Avlese vannmengde 08 (Man):') }} </label>
							@if ($day==='Monday')
								@if(in_array('D_Vannmengde_08', $done))
								   <span class='glyphicon glyphicon-ok'></span>
								@else 
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('D_Vannmengde_08', 'Utført')  }}  
									</div>
								@endif
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif
						</div>	  
					</div>
				   					
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Renhold_Av_Wc', 'Renhold av WC (Man til Fre):') }} </label>
							@if ($day==='Monday' || $day==='Tuesday' || $day==='Wednesday' || $day==='Thursday' || $day==='Friday' )
								@if(in_array('D_Renhold_Av_Wc', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else  
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('D_Renhold_Av_Wc', 'Utført')  }}  
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
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Filter_Rens', 'Filterrens/spyle filter (Tir og Fre):') }} </label>
							@if ($day==='Tuesday' || $day==='Friday')
								@if(in_array('D_Filter_Rens', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else 
									<div class="col-md-6 col-lg-6">
										{{ Form::checkbox('D_Filter_Rens', 'Utført')  }}  
									</div>
								@endif
							@else
								<span class='glyphicon glyphicon-remove'></span>
							@endif         			
						</div>  
					</div>
					   
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Ettersyn_Utst_Skap', 'Ettersyn av Utstyr/skap:') }} </label>
						  <div class="col-md-6 col-lg-6">     
								@if(in_array('D_Ettersyn_Utst_Skap', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Ettersyn_Utst_Skap', 'Utført')  }}  
								@endif  
						  </div>
						</div>
					</div>
					
				</div>
			  
				<hr>
				
				<div class="row">
				
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Bypass_Pl_Bass', 'Bypass Pl. Basseng (Man og Ons):') }} </label>
								@if ($day==='Monday' || $day==='Wednesday')
									@if(in_array('D_Bypass_Pl_Bass', $done))
									   <span class='glyphicon glyphicon-ok'></span>
									@else 
										<div class="col-md-6 col-lg-6">
											{{ Form::checkbox('D_Bypass_Pl_Bass', 'Utført')  }}  
										</div>
									 @endif
								@else
									<span class='glyphicon glyphicon-remove'></span>
								@endif    
						</div> 
					</div>
					 
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Handicap_Heis', 'Handicap Heis:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('D_Handicap_Heis', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Handicap_Heis', 'Utført')  }} 
								@endif 
							</div>
						</div>
					</div>
					
				</div>
			  
				<hr>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vaske_Gulv_CM', 'Vaske gulv m/ CM (Man til Fre):') }} </label>
								@if ($day !=='Saturday' && $day !=='Sunday' )
									@if(in_array('D_Vaske_Gulv_CM', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else  
										<div class="col-md-6 col-lg-6">
											{{ Form::checkbox('D_Vaske_Gulv_CM', 'Utført')  }}  
										</div>
									@endif
								@else
									<span class='glyphicon glyphicon-remove'></span>
								@endif    
						</div>
					</div>

					 
					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Ettersyn_solarier', 'Ettersyn av Solarier x2:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('D_Ettersyn_solarier', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Ettersyn_solarier', 'Utført')  }} 
								@endif 
							</div>
						</div>
					</div>
				</div>
			  
					<hr>
				
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Garderobe_0730', 'Garderobe Kl. 07:30:') }} </label>
						  <div class="col-md-6 col-lg-6">
								@if(in_array('D_Garderobe_0730', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Garderobe_0730', 'Utført')  }} 
								@endif 
						  </div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vannprover_0745', 'Vannprøver/registrering 07:45:') }} </label>
						  <div class="col-md-6 col-lg-6">
								@if(in_array('D_Vannprover_0745', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Vannprover_0745', 'Utført')  }}  
								@endif 
						  </div>
						</div>
					 </div>
				</div>
			  
				<hr>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Garderobe_Dag', 'Garderobe midt på dagen:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('D_Garderobe_Dag', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('D_Garderobe_Dag', 'Utført')  }}   
									@endif    
								</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vannprover_1100', 'Vannprøver/registrering 11:00:') }} </label>
							<div class="col-md-6 col-lg-6">
								@if(in_array('D_Vannprover_1100', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Vannprover_1100', 'Utført')  }}
								@endif    
							</div>
						</div>
					 </div>
				</div>
			  
				<hr>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Male_Temp_Just', 'Måle Temp + just:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('D_Male_Temp_Just', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('D_Male_Temp_Just', 'Utført')  }}  
									@endif
								</div>
						</div>
					</div>

					<div class="col-md-6 text-left-imp"> 
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vannprover_1400', 'Vannprøver/registrering 14:00:') }} </label>
						  <div class="col-md-6 col-lg-6">
								@if(in_array('D_Vannprover_1400', $done))
									<span class='glyphicon glyphicon-ok'></span>
								@else
									{{ Form::checkbox('D_Vannprover_1400', 'Utført')  }}   
								@endif
						  </div>
						</div>
					</div>
					
				</div>
			  
				<hr>
				
				<div class="row">
				  
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Vaske_Pl_Bass', 'Vaske kant/renner Pl. Basseng (Tir og Lør):') }} </label>
								@if ($day==='Tuesday' || $day==='Saturday')
									@if(in_array('D_Vaske_Pl_Bass', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else  
										<div class="col-md-6 col-lg-6">
											{{ Form::checkbox('D_Vaske_Pl_Bass', 'Utført')  }}  
										</div>
									@endif
								@else
									<span class='glyphicon glyphicon-remove'></span>
								@endif
						</div>
					</div>
					 
					<div class="col-md-6 text-left-imp"> 
				
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Enkle_Vedlikholds_Oppg', 'Enkle vedlikeholdsoppgaver Tas straks:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('D_Enkle_Vedlikholds_Oppg', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('D_Enkle_Vedlikholds_Oppg', 'Utført')  }}
									@endif
								</div>
						</div>
					</div>
					
				</div>
				
				<hr>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label"></label>
							<div class="col-md-6 col-lg-6">
					   
							</div>
						</div>
					</div>
					 
					<div class="col-md-6 text-left-imp"> 
					
						<div class="form-group">
							<label class="col-md-6 col-lg-6 control-label">{{ Form::label('D_Sjekk_Skiftplan', 'Sjekk skiftplan:') }} </label>
								<div class="col-md-6 col-lg-6">
									@if(in_array('D_Sjekk_Skiftplan', $done))
										<span class='glyphicon glyphicon-ok'></span>
									@else
										{{ Form::checkbox('D_Sjekk_Skiftplan', 'Utført')  }}
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
					</div>
					<br>
				</div>
				{{ Form::close() }}

			</div>
		</div>
  </div>
@stop