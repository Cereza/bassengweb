<?php
require ('connection.php');
//This is the file for generating Excel documents, first it will fetch kind of task/measurement then generate the report based on the criteria

$timezone = "Europe/Oslo";
date_default_timezone_set($timezone);
$format="%H%M%S";
$strf=strftime($format);

$filename = "$strf"; 

if(isset($_POST['excel']))

	{
		$fraDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['fraDato']);
		$tilDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['tilDato']);
		$fraDato = $fraDato1->format('Y/m/d');
		$tilDato = $tilDato1->format('Y/m/d');

		
		if (isset($_POST['hent']))
		{	

			$basseng = $_POST['mypool'];

			if($_POST['hent'] == 'timesmaling')
			{
				$sql = "
				SELECT measurements.title as Maling, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, pools.name as Basseng, emps.user_name as Ansatt
				FROM routines, measure_routine, measurements, pools, emps
				WHERE routines.id = measure_routine.routine_id
				AND measure_routine.measure_id = measurements.id
				AND (measurements.title  Like 'T_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
				AND measure_routine.pool_id=pools.id
				AND pools.name = '$basseng' 
				AND Date between '".$fraDato."' and '".$tilDato."' 
				ORDER BY routines.date DESC";
			}
				
			elseif($_POST['hent'] == 'vannmaling')
			{

				$sql = "
				SELECT measurements.title as Maling, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, pools.name as Basseng, emps.user_name as Ansatt
				FROM routines, measure_routine, measurements, pools, emps
				WHERE routines.id = measure_routine.routine_id
				AND measure_routine.measure_id = measurements.id
				AND (measurements.title  Like 'M_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
				AND measure_routine.pool_id=pools.id 
				AND pools.name = '$basseng' 
				AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";
			}
				
				
			elseif($_POST['hent'] == 'oppgaver')
			{
				$sql = "
				SELECT measurements.title as Maling, routines.value as Verdi, CONVERT(varchar(10),routines.date, 105) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, pools.name as Basseng, emps.user_name as Ansatt
				FROM routines, measure_routine, measurements, pools, emps
				WHERE routines.id = measure_routine.routine_id
				AND measure_routine.measure_id = measurements.id
				AND (measurements.title  Like 'O_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
				AND measure_routine.pool_id=pools.id 
				AND pools.name = '$basseng' 
				AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";
			}
			
			elseif($_POST['hent'] == 'autoTemperatur')
			{
				$sql = "
				SELECT measurements.title as Maling, routines.value as Verdi, CONVERT(varchar(10),routines.date, 105) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, pools.name as Basseng, emps.user_name as Ansatt
				FROM routines, measure_routine, measurements, pools, emps
				WHERE routines.id = measure_routine.routine_id
				AND measure_routine.measure_id = measurements.id
				AND (measurements.title  Like 'A_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
				AND measure_routine.pool_id=pools.id 
				AND pools.name = '$basseng' 
				AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";
			}

				
			elseif($_POST['hent'] == 'dagvakt')
			{
				$sql = "
				SELECT tasks.title as Tittel, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, emps.user_name as Ansatt
				FROM routines, task_routine, tasks, emps
				WHERE routines.id = task_routine.routine_id
				AND task_routine.task_id = tasks.id
				AND (tasks.title  Like 'D_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";

			}
				
			elseif($_POST['hent'] == 'kveldsvakt')
			{
				$sql = "	
				SELECT tasks.title as Oppgaver, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, emps.user_name as Ansatt
				FROM routines, task_routine, tasks, emps
				WHERE routines.id = task_routine.routine_id
				AND task_routine.task_id = tasks.id
				AND (tasks.title  Like 'K_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";

			}
				
			elseif($_POST['hent'] == 'kontrollcm')
			{
				$sql = "
				SELECT tasks.title as Oppgaver, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, emps.user_name as Ansatt
				FROM routines, task_routine, tasks, emps
				WHERE routines.id = task_routine.routine_id
				AND task_routine.task_id = tasks.id
				AND (tasks.title  Like 'C_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";
			}

			elseif($_POST['hent'] == 'helgevakt')
			{
				$sql = "
				SELECT tasks.title as Oppgaver, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, emps.user_name as Ansatt
				FROM routines, task_routine, tasks, emps
				WHERE routines.id = task_routine.routine_id
				AND task_routine.task_id = tasks.id
				AND (tasks.title  Like 'H_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC";
			}


			$result=sqlsrv_query($conn,$sql) or die("Couldn't execute query:<br>" . sqlsrv_error(). "<br>" . sqlsrv_errno()); 

			$file_ending = "csv";
			$reals=array();
			
			//header info for browser
			header("Content-Type: application/csv");    
			header("Content-Disposition: attachment; filename=$strf.csv");  //filename come
			header("Pragma: no-cache"); 
			header("Expires: 0");
			
			/*******Start of Formatting for Excel*******/   
			//define separator (defines columns in excel)
			$sep = "\t"; //tabbed character

			$firstRow = true;

			//start while loop to get data
			while($row = sqlsrv_fetch_array($result))
			{
			  if($firstRow)
			  {
				$names = array_keys($row);
				$namesToPrint = '';

				foreach($names as $idx => $name)
				{
					if($idx % 2 != 0)
					{
						$namesToPrint .= $name.$sep;
					}
				}

				$namesToPrint = substr($namesToPrint, 0, -1);
				
				$forste = 'sep=<x>'; //seperator for cell seperating
				
				print $forste."\n"; 
				
				print $namesToPrint."\n";

				$firstRow = false;
			  }

			   $schema_insert = "";
			   for($j = 0; $j < sqlsrv_num_fields($result); $j++)
			   {
				  if ($row[$j] != "") {
					 if (in_array($j, $reals)) {
						$schema_insert .= str_replace(".",",", $row[$j]) . $sep;
					 } else {
						$schema_insert .= $row[$j] . $sep;
					 }
				  }
				  else
					 $schema_insert .= "" . $sep;
			   }

			   $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
			   $schema_insert .= "\t";
			   print(trim($schema_insert));
			   print "\n";
			}
		}
	}
?>