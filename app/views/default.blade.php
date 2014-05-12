<!DOCTYPE html>
<html>
<!-- This is the master page for all of the pages, and here is the navigation for all of the pages defined.  -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>{{ $title }}</title>
</head>
<body>
   
   <!-- Bootstrap CSS here -->
   <link type="text/css" rel="stylesheet" href="{{ URL::to('css/bootstrap.css') }}"> 
   <!-- Custom CSS here -->
   <link type="text/css" rel="stylesheet" href="{{ URL::to('css/main.css') }}">
   <!-- jQuery -->
   <script src="{{ URL::to('js/jquery.min.js') }}"></script>
   <!-- JavaScript -->
   <script src="{{ URL::to('js/bootstrap.js') }}"></script>

   
	<?php
		session_start(); 
		$_SESSION['bruker'] = Auth::user()->user_name;
	?>
    
  <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
			  
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		</div>
				
		<div class="navbar-collapse collapse">
			<p class="navbar-text pull-right">
				<span class="glyphicon glyphicon-user"></span> 
				<span class="label label-info" style="color:white"><a class='navbar-link {{ ($aktiv == 'minside ') ? 'active' : '' }}'  >
				{{ HTML::linkRoute('user_data', 'Min side: '.Auth::user()->user_name) }} </a> </span> 
				<span class="label label-danger"> {{ HTML::linkRoute('logout', 'Logg ut') }}</span></p> 
			<!--- Select bar --->
			<ul class="nav navbar-nav pull-left">
			  
				<li class='pil {{ ($aktiv == 'timemaling') ? 'active' : '' }}' > <a class='timemaling' {{HTML::linkRoute('timemaling','Timemåling')}}</a> </li>            
				<li  class='pil {{ ($aktiv == 'vannmaling') ? 'active' : '' }}'> <a class='vannmaling' {{HTML::linkRoute('vannmaling','Vannmåling')}}</a </li>
				<li  class='pil {{ ($aktiv == 'oppgaver') ? 'active' : '' }}'> <a class='oppgaver' {{HTML::linkRoute('oppgaver','Oppgaver')}}</a> </li>         
				<!--- Dropdown --->
			   <li class='pil dropdown {{ ($aktiv == 'dagvakt' || $aktiv== 'kveldsvakt' || $aktiv=='helgevakt') ? 'active' : '' }}'>
				<a    href="#" class="dropdown-toggle glyphicon glyphicon-ok" data-toggle="dropdown"><span class="glyphicon glyphicon-ok" ></span> <big>Rutiner</big> <b class="caret"></b></a>
				
					<ul class="dropdown-menu">
				<li class='{{ ($aktiv == 'dagvakt') ? 'active' : '' }}'> <a class='dagvakt' {{HTML::linkRoute('dagvakt','Dagvakt')}}</a> </li> 
				<li class='{{ ($aktiv == 'kveldsvakt') ? 'active' : '' }}'> <a class='kveldsvakt' {{HTML::linkRoute('kveldsvakt','Kveldsvakt')}}</a> </li>  
				<li class='{{ ($aktiv == 'helgevakt') ? 'active' : '' }}'> <a class='helgevakt' {{HTML::linkRoute('helgevakt','Helgevakt')}}</a> </li>      
			</ul>   
			</li>

			<li  class='pil {{ ($aktiv == 'kontrollcm') ? 'active' : '' }}' > <a class='kontrollcm' {{HTML::linkRoute('kontrollcm','Vask med CM')}}</a> </li> 
			<li  class='pil  {{ ($aktiv == 'sok') ? 'active' : '' }}'> <a class='sok' {{HTML::linkRoute('sok','Søk')}}</a> </li>    
			<li  class='pil {{ ($aktiv == 'rapport') ? 'active' : '' }}' > <a class='rapport' href='../rapport/index.php'>Rapport</a> </li>           
			<li class='pil {{ ($aktiv == 'diagram') ? 'active' : '' }}'> <a class='diagram' href='../diagram/index.php'>Diagram</a> </li>   
		  </ul>      
		</div><!--/.nav-collapse -->

    </div>
      <br><br>
   
  
  @yield('content')
  
</body>
</html>
