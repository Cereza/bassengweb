<!DOCTYPE html>
<html>
<!-- This is the index file for rapport, which shows the forms and redirects to either PDF convert or Excel -->
		<head>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="">
			<meta name="author" content="">
			
			<!-- Bootstrap CSS here -->
			<link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
			<!-- Custom CSS here -->
			<link type="text/css" rel="stylesheet" href="../css/main.css">
			<!-- jQuery -->
			<script src="../js/jquery.min.js"></script>
			<!-- JavaScript -->
			<script src="../js/bootstrap.js"></script>
			
			<title>Rapport</title>
		</head>

<body>
		<?php 
			$page = 'rapport';
			$_SESSION['rapport']= $page;
			include('navigasjon.html');
		?>

	
	<div class="jumbotron" > <!-- outer container -->
		<br><br>
		<div class="container" > <!-- Container -->
			<div class="row" >
				<div class="col-lg-12" >
					<br>
					<h2><span class="glyphicon glyphicon-list-alt"></span> Rapport </h2>
					<hr>
				</div>
					
				<div class="alle">

					<form action="generatePdf.php" method="Post" class="form-horizontal">
							
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-6 col-lg-6 control-label">Fra dato: </label>
									<div class="col-md-6 col-lg-6">
										<input type="text" class="form-control" name="fraDato" value="<?php echo date('d/m/Y'); ?>"> 
									</div>
								</div>
							</div>

							<div class="col-md-6 text-left-imp"> 
								<div id="dato">
									<div class="form-group">
										<label class="col-md-4 control-label">Til dato: </label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="tilDato" value="<?php echo date('d/m/Y'); ?>"> 
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="row">
									
							<div class="form-group">
								<label  class="col-md-1 control-label">Velg: </label>
								<div class="col-md-4">
									<?php
									require ('connection.php');
										
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
							
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-7 control-label">Timesmåling: </label>
										<div class="col-md-2">
											<input type="radio" class="form-control" name="hent" value="timesmaling">
										</div>
								</div>
							</div>
										
							<div class="col-md-6 text-left-imp">
								<div class="form-group">
								   <label class="col-md-5 control-label">Kveldsvakt: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="kveldsvakt">
									</div>
								</div>
							</div>
		
						</div>
								  
						<div class="row">
								   
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-7 control-label">Vannmåling: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="vannmaling">
									</div>
								</div>  
							</div>
									
							<div class="col-md-6 text-left-imp">
								<div class="form-group">
									<label class="col-md-5 control-label">Dagvakt: </label>
										<div class="col-md-2">
											<input type="radio" class="form-control" name="hent" value="dagvakt">
										</div>
								</div> 
							</div>
									
									
						</div>
								  
						<div class="row">
						
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-7 control-label">Oppgaver: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="oppgaver">
									</div>
								</div> 
							</div>
										
							<div class="col-md-6 text-left-imp">
								<div class="form-group">
									<label class="col-md-5 control-label">Kontroll CM: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="kontrollcm">
									</div>
								</div>
							</div>
									
						</div>
							
						<div class="row">
						
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-7 control-label">Automatikk: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="autoTemperatur">
									</div>	
								</div> 
							</div>
									
									
							<div class="col-md-6 text-left-imp">
								<div class="form-group">
									<label class="col-md-5 control-label">Helgevakt: </label>
									<div class="col-md-2">
										<input type="radio" class="form-control" name="hent" value="helgevakt">
									</div>
								</div>
							</div>
									
						</div>

						<div class="row">
							
							<div class="col-md-6 text-right">
								<input type="submit" name="pdf" value="PDF" class="btn btn-primary" formaction="generatePdf.php">
							</div>
							<div class="col-md-6">
								<input type="submit" name="excel" value="Excel" class="btn btn-primary" formaction="generateExcel.php"> 
							</div>
							
						</div>

					</form>	
				</div>
			</div> 
		</div>
	</div>
</body>
</html>