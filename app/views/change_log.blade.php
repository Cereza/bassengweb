@extends('default')

@section('content')
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
	   <br><br>
<div class="jumbotron" >
<div class="container-diagram" >
<div class="row" >
<div class="col-lg-12" >

 <br>
<h2><span class="glyphicon glyphicon-th-list"></span> Endringslogg </h2>
<hr>
    
    
    <div id="response" > 
        @if(Session::has('message'))
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    </div>
	   @endif
<head>
	<title>{{ $title }}</title>
	 
</head>
<body>
<div class="row">
    {{ Form::open(array('url' => 'bassengweb/chlog', 'method' => 'GET')) }}
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-5 control-label">{{ Form::label('fraDato', 'Fra dato:') }} </label>
					<div class="col-md-6 col-lg-6">
					{{ Form::text('fraDato', Input::old('fraDato'), array('placeholder' => '15/04/2014', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
  
    <div class="col-md-6 text-left-imp"> 
		
			
				<div class="form-group">
					<label class="col-md-4 control-label">{{ Form::label('tildato', 'Til dato:') }} </label>
					<div class="col-md-6 col-lg-6">
					 {{ Form::text('tilDato', Input::old('tilDato'), array('placeholder' => '15/04/2014', 'class' => 'form-control')) }}
					</div>
				</div>
		
		
	</div>
</div>
    
    <br>
    
<div class="row">    
  <div class="form-group">
    <div class="col-md-offset-4 col-md-4">
       {{ Form::submit('Søk', array('class' => 'btn btn-primary')) }}
       {{ HTML::linkRoute('change_log', 'Vis alle endringer', array(), array('class' => 'btn btn-primary')) }} 
        {{ Form::close() }}
    </div>
  </div>

</div>
    <hr>
    

    
<table  class='table table-hover'>
	<tr class='active'>
		<td>Original ID</td>
		<td>Tittel</td>
		<td>Gammel Verdi</td>
		<td>Ny Verdi</td>
		<td>Type Endring</td>
		<td>Lagret</td>
		<td>Endret</td>
		<td>Tid</td>
		<td>Endret av</td>
	</tr>
	@foreach ($changes as $change)
		<tr>
			<td>{{ $change->routine_id }}</td>
			<td>{{ $change->title }}</td>
			<td>{{ $change->value_old }}</td>
			<td>{{ $change->value_new }}</td>
			<td>{{ $change->action }}</td>
			<td>{{ date('d/m/Y', strtotime($change->date)) }}</td>
			<td>{{ date('d/m/Y', strtotime($change->changed_at)) }}</td>
			<td>{{ $change->time }}</td>
			<td>{{ $change->changed_by }}</td>
		</tr>	
	@endforeach
</table>

{{ $changes->appends(Input::except('page'))->links() }}
<br/>




</body>
</html>