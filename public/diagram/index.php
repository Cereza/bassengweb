<!DOCTYPE html>
<html>
	<!-- This file is the content of the diagram (google chart) file which shows the form  -->
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Diagram</title>
	</head>
	
	<body>
		<!-- Bootstrap custom CSS here -->
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
		<!-- Custom CSS here -->
		<link type="text/css" rel="stylesheet" href="../css/main.css">
		<!-- jQuery -->
		<script src="../js/jquery.min.js"></script>
		<!-- JavaScript -->
		<script src="../js/bootstrap.js"></script>
		
		
		<?php
		  $page = 'diagram';
		  $_SESSION['diagram']= $page;
		  include 'kode.php';
		  include('../rapport/navigasjon.html');
		?>
		
		<div class="jumbotron" >
			<br><br>
			<div class="container-diagram" >

			<div class="col-lg-12" >
			
				<br>
				<h2><span class="glyphicon glyphicon-stats"></span> Diagram </h2>
				<hr>

			</div>
					
				
				<div class="alle5">
				   
					<form name="input" action="" method="POST" class="form-horizontal">
				  
						<div class="row">
					  
							<div class="col-md-6">
								<div class="form-group ">
									<label class="col-md-6 col-lg-6 control-label">Fra dato: </label>
									<div class="col-md-6 col-lg-6">
										<input type="text" name="fraDato" value="<?php echo date('d/m/Y'); ?>"  class="form-control" /> 
									</div>
								</div>
							</div>
								
							<div class="col-md-6">
								<div class="form-group" >
								<label class="col-md-6 col-lg-6 control-label">Til dato: </label>
									<div class="col-md-6 col-lg-6">
										<input type="text" name="tilDato" value="<?php echo date('d/m/Y'); ?>" class="form-control" > 
									</div>
								</div>
							</div>
					  
						</div>
					  
						<div class="row">
					  
							<div class="col-md-6">
								<div class="form-group">
								<label class="col-md-6 col-lg-6 control-label">Fra Tid: </label>
									<div class="col-md-6 col-lg-6">
										<input type="text" name="fraTid" value="<?php echo "$strf"; ?>" class="form-control"> 
									</div>
								</div>
							</div>
									
							<div class="col-md-6">
								<div class="form-group">
								<label class="col-md-6 col-lg-6 control-label">Til Tid: </label>
									<div class="col-md-6 col-lg-6">
										<input type="text" name="tilTid" value="<?php echo "$strf"; ?>" class="form-control"> 
									</div>
								</div>
							</div>
					  
						</div>
					  
					  
						<div class="row">
					  
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 col-lg-4 control-label">Basseng: </label>
									<div class="col-md-8 col-lg-8">	 
										<?php
											$result = sqlsrv_query($conn,"Select name from pools");

											echo "<select name='mypool' class='form-control'>";
											
											$default_name = "foo_bar"; 
											while($row = sqlsrv_fetch_array($result)){
											  $opt_name = $row['name'];
											  $str_selected = "";
											  if($opt_name == $default_name){
												  $str_selected = "selected";
											}
											  echo "<option value='".$opt_name."' ".$str_selected." >" . $opt_name. "</option>";
											}

											echo "</select>";
											
											sqlsrv_close($conn);
					
										?>
									</div>
								</div>
							</div>
					  
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-6 col-lg-6 control-label"> </label>
									<div class="col-md-6 col-lg-6">
										<input type="submit" name="submit" value="Hent" class="btn btn-primary" />
									</div>
								</div>
							</div>

						</div>

				</div>
				
				<?php

					if(isset($_POST['submit']))
					{

						echo "

							<div class='row'>
							  <div class='col-md-2'>
							 <input type='checkbox' id='Temperatur' value='Temperatur'/> Temperatur 
							  </div>
							  <div class='col-md-2'>
							  <input type='checkbox' id='BundetKlor' value='BundetKlor'> Bundet Klor 
							  </div>
							   <div class='col-md-2'>
							<input type='checkbox' id='Luft_Temperatur' value='Luft_Temperatur'> Luft Temperatur 
							  </div>
								<div class='col-md-2'>
							<input type='checkbox' id='FrittKlor' value='FrittKlor'> Fritt Klor
							  </div>
							   <div class='col-md-2'>
							<input type='checkbox' id='Badende_Per_Time' value='Badende_Per_Time'> Badende Per Time 
							  </div>
							  
							   <div class='col-md-2'>
							<input type='checkbox' id='TotalKlor' value='BundetKlor'> Total Klor 
							  </div>  
							  
								<div class='col-md-2'>
							<input type='checkbox' id='PH' value='PH'> PH
							  </div>  
								   <div class='col-md-2'>
							<input type='checkbox' id='AutoKlor' value='AutoKlor'> Auto Klor
							  </div>  
							  
							    <div class='col-md-2'>
							<input type='checkbox' id='AutoTemperatur' value='AutoTemperatur'> Auto Temperatur
							  </div>
							   
									<div class='col-md-2'>
							<input type='checkbox' id='AutoPh' value='AutoPh'> Auto Ph
							  </div>  
							  <div class='col-md-5'>
							 <p>Velg målinger som skal vises </p>
							  </div>  
							  
								
							  </div>
							  
						  ";
					}
				?>
				  
					<hr>
					<?php
					if(isset($_POST['submit']))
					{
						echo "<div id='response'> <p>Marker området som skal forstørres, høyre-klikk for å tilbakestille</p> </div>";
					}
					?>
				 <div id="chart_div" style="width: 900px; height: 500px;"></div>
					 
				</form> 
			</div>
		</div> 
			<!-- This is the google chart code -->
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
			
				
			Temperatur = document.getElementById('Temperatur'), 
			Badende_Per_Time = document.getElementById('Badende_Per_Time'),
			Luft_Temperatur = document.getElementById('Luft_Temperatur');
			FrittKlor = document.getElementById('FrittKlor');
			BundetKlor = document.getElementById('BundetKlor');
			TotalKlor = document.getElementById('TotalKlor');
			PH = document.getElementById('PH');
			AutoKlor = document.getElementById('AutoKlor');
			AutoPh = document.getElementById('AutoPh');
			AutoTemperatur = document.getElementById('AutoTemperatur');
				
			  google.load("visualization", "1", {packages:["corechart"]});
			  google.setOnLoadCallback(drawChart);
			  
			Temperatur.onchange = drawChart;
			Badende_Per_Time.onchange = drawChart;
			Luft_Temperatur.onchange = drawChart;
			FrittKlor.onchange = drawChart;
			BundetKlor.onchange = drawChart;  
			TotalKlor.onchange = drawChart; 
			PH.onchange = drawChart; 	
			AutoKlor.onchange = drawChart;
			AutoPh.onchange = drawChart;
			AutoTemperatur.onchange = drawChart;
			
			
			  function drawChart() {
				var data = new google.visualization.DataTable(<?=$jsonTable?>);
				
				var options = {
				 width: 1100, height: 520, 
				  title: 'Diagram',
				  curveType: 'function', 
				   legend: { position: 'bottom' },
				   pointSize: 5,
				vAxis: {title: "Verdi", titleTextStyle: {italic: false}},
				hAxis: {title: "Tid", titleTextStyle: {italic: false}},
				explorer: { actions: ['dragToZoom', 'rightClickToReset'], 
							axis: 'both' },
							
					focusTarget: 'category',
					
					interpolateNulls: true,
							
						
			   };
			   
			   if (!AutoTemperatur.checked) data.removeColumn(10);
			   if (!AutoPh.checked) data.removeColumn(9);
			   if (!AutoKlor.checked) data.removeColumn(8);
			   if (!PH.checked) data.removeColumn(7);
			   if (!TotalKlor.checked) data.removeColumn(6);
			   if (!BundetKlor.checked) data.removeColumn(5); 
			   if (!FrittKlor.checked) data.removeColumn(4); 
			   if (!Luft_Temperatur.checked) data.removeColumn(3); 
			   if (!Badende_Per_Time.checked) data.removeColumn(2);
			   if (!Temperatur.checked) data.removeColumn(1);
				
				var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				
			  }
			</script>

	</body>

</html>	