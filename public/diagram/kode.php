<?php
	//This is the backend code for the google chart, the sql query gets the different type of measurement based on date, time and pool criteria. 
	require ('../rapport/connection.php');
	$timezone = "Europe/Oslo";
	date_default_timezone_set($timezone);
	$format="%H:%M";
	$strf=strftime($format);

	if(isset($_POST['submit']))
	{

		$basseng = $_POST['mypool'];
		$fraDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['fraDato']);
		$tilDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['tilDato']);
		$fraDato = $fraDato1->format('Y/m/d');
		$tilDato = $tilDato1->format('Y/m/d');

		$fraTid = $_REQUEST['fraTid'];
		$tilTid = $_REQUEST['tilTid'];

		$sth = sqlsrv_query($conn,"

			SELECT routines.date, routines.time, 
			SUM( CASE WHEN measurements.title =  'T_Temperatur' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS Temperatur,
			SUM( CASE WHEN measurements.title =  'T_Badende_per_Time' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS Badende_Per_Time,
			SUM( CASE WHEN measurements.title =  'T_Luft_Temperatur' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS Luft_Temperatur,
			SUM( CASE WHEN measurements.title =  'M_Fritt_Klor' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS FrittKlor,
			SUM( CASE WHEN measurements.title =  'M_Bundet_Klor' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS BundetKlor,
			SUM( CASE WHEN measurements.title =  'M_Total_Klor' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS TotalKlor,
			SUM( CASE WHEN measurements.title =  'M_PH' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS PH,
			SUM( CASE WHEN measurements.title =  'M_Auto_Klor' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS AutoKlor,
			SUM( CASE WHEN measurements.title =  'M_Auto_PH' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS AutoPh,
			SUM( CASE WHEN measurements.title =  'A_Auto_Temperatur' THEN CAST( REPLACE( routines.value,  ',',  '.' ) AS DECIMAL( 18, 2 ) ) ELSE NULL END) AS AutoTemperatur
			FROM routines
			INNER JOIN measure_routine ON routines.id = measure_routine.routine_id
			INNER JOIN measurements ON measure_routine.measure_id = measurements.id
			INNER JOIN pools ON measure_routine.pool_id = pools.id

			WHERE routines.date between '".$fraDato."' AND '".$tilDato."'
			AND (pools.name = '".$basseng."' OR pools.name = 'Svommehall') 
			AND routines.time between '".$fraTid."' AND '".$tilTid."'

			GROUP BY routines.date, routines.time
			ORDER BY routines.date, routines.time;

		;");

		if( $sth === false ) {
			 die( print_r( sqlsrv_errors(), true));
		}

	   $rows = array();
	   $flag = true;
	   $table = array();
	   $table['cols'] = array(
		
	   array('label' => 'routines.date' & 'routines.time', 'type' => 'datetime'),
	   array('label' => 'Temperatur', 'type' => 'number'),	
	   array('label' => 'Badende_Per_Time', 'type' => 'number'),
	   array('label' => 'Luft_Temperatur', 'type' => 'number'),	
	   array('label' => 'FrittKlor', 'type' => 'number'),
	   array('label' => 'BundetKlor', 'type' => 'number'),   
	   array('label' => 'TotalKlor', 'type' => 'number'), 
	   array('label' => 'PH', 'type' => 'number'),
	   array('label' => 'AutoKlor', 'type' => 'number'),
	   array('label' => 'AutoPh', 'type' => 'number'),
	   array('label' => 'AutoTemperatur', 'type' => 'number'),
	   
		);
		
		$rows = array();
		
		
		while($r = sqlsrv_fetch_array  ($sth)) 
		{
			
			//$temp = array();
			// assumes dates are in the format "yyyy-MM-dd"
			
			$dateString = $r['date'];
			$year = $dateString->format('Y');
			$month = $dateString->format('m') -1;
			$day = $dateString->format('d');
			
			// assumes time is in the format "hh:mm:ss"
			
			$timeString = $r['time'];
			$hours = $timeString->format('G');
			$minutes = $timeString->format('i');
			$seconds = $timeString->format('s');
			
			$temp = array();
			$temp[] = array('v' => "Date($year, $month, $day, $hours, $minutes, $seconds)"); 
			$temp[] = array('v' => $r['Temperatur']);
			$temp[] = array('v' => $r['Badende_Per_Time']);
			$temp[] = array('v' => $r['Luft_Temperatur']);
			$temp[] = array('v' => $r['FrittKlor']);
			$temp[] = array('v' => $r['BundetKlor']);
			$temp[] = array('v' => $r['TotalKlor']);
			$temp[] = array('v' => $r['PH']);
			$temp[] = array('v' => $r['AutoKlor']);
			$temp[] = array('v' => $r['AutoPh']);
			$temp[] = array('v' => $r['AutoTemperatur']);
			
			$rows[] = array('c' => $temp);
		
		} 

			 $table['rows'] = $rows;
			 $jsonTable = json_encode($table, JSON_NUMERIC_CHECK);
			//echo $jsonTable;	
			
	}	
?>