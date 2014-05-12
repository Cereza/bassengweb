<?php
	require('mysql_table.php');
	//Connect to database
	require ('connection.php');
	
//This file generate the PDF, first it will choose what the user have chosen in the form and generate the PDF out of the criteria available.

	$timezone = "Europe/Oslo";
	date_default_timezone_set($timezone);
	$format="%H%M%S";
	$strf=strftime($format);

	 if(isset($_POST['pdf']))
	{
		$fraDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['fraDato']);
		$tilDato1 = DateTime::createFromFormat('d/m/Y', $_REQUEST['tilDato']);
		$fraDato = $fraDato1->format('Y/m/d');
		$tilDato = $tilDato1->format('Y/m/d');
		 
		class PDF extends PDF_MySQL_Table
		{

			function Header()
			{
				//Title
				$this->SetFont('Arial','',18);
				$this->Cell(0,6,'Malinger/Oppgaver',0,1,'C');
				$this->Ln(10);
				//Ensure table header is output
				parent::Header();
			}
		}
		
		//Generates PDF
		$pdf=new PDF();
		$pdf->AddPage();

		

		if (isset($_POST['hent']))
		{
			$basseng = $_POST['mypool'];

			if($_POST['hent'] == 'timesmaling')
				{
				
					$pdf->AddCol('Tittel', 50, '', 'C'); 
					$pdf->AddCol('Verdi', 25, '', 'C');
					$pdf->AddCol('Tid', 25, '', 'C');
					$pdf->AddCol('Dato', 25, '', 'C');
					$pdf->AddCol('Basseng', 30, '', 'C');
					$pdf->AddCol('Ansatt', 30, '', 'C');

					$pdf->Table("

						SELECT measurements.title as Tittel, routines.value as Verdi, CONVERT(VARCHAR(10),routines.date,103) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, pools.name as Basseng, emps.user_name as Ansatt
						FROM routines, measure_routine, measurements, pools, emps
						WHERE routines.id = measure_routine.routine_id
						AND measure_routine.measure_id = measurements.id
						AND (measurements.title  Like 'T_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
						AND pools.name = '".$basseng."' 
						AND Date between '".$fraDato."' and '".$tilDato."'
						ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D'); 

			    }
			  
				elseif($_POST['hent'] == 'vannmaling')
				{
				
					$pdf->AddCol('Tittel', 50, '', 'C'); 
					$pdf->AddCol('Verdi', 25, '', 'C');
					$pdf->AddCol('Tid', 25, '', 'C');
					$pdf->AddCol('Dato', 25, '', 'C');
					$pdf->AddCol('Basseng', 30, '', 'C');
					$pdf->AddCol('Ansatt', 30, '', 'C');
						
					$pdf->Table("

						SELECT measurements.title as Tittel, routines.value as Verdi, CONVERT(VARCHAR(10),routines.date,103) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, pools.name as Basseng, emps.user_name as Ansatt
						FROM routines, measure_routine, measurements, pools, emps
						WHERE routines.id = measure_routine.routine_id
						AND measure_routine.measure_id = measurements.id
						AND (measurements.title  Like 'M_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
						AND pools.name = '".$basseng."' 
						AND Date between '".$fraDato."' and '".$tilDato."'
						ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D'); 
				}
				
				elseif($_POST['hent'] == 'oppgaver')
				{
				
						$pdf->AddCol('Tittel', 50, '', 'C'); 
						$pdf->AddCol('Verdi', 25, '', 'C');
						$pdf->AddCol('Tid', 25, '', 'C');
						$pdf->AddCol('Dato', 25, '', 'C');
						$pdf->AddCol('Basseng', 30, '', 'C');
						$pdf->AddCol('Ansatt', 30, '', 'C');
							
						$pdf->Table("
							SELECT measurements.title as Tittel, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(VARCHAR(10),routines.date,103) as Dato, pools.name as Basseng, emps.user_name as Ansatt
							FROM routines, measure_routine, measurements, pools, emps
							WHERE routines.id = measure_routine.routine_id
							AND measure_routine.measure_id = measurements.id
							AND (measurements.title  Like 'O_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
							AND pools.name = '".$basseng."' 
							AND Date between '".$fraDato."' and '".$tilDato."'
							ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D');
				
				}
				
				elseif($_POST['hent'] == 'autoTemperatur')
				{
				
						$pdf->AddCol('Tittel', 50, '', 'C'); 
						$pdf->AddCol('Verdi', 25, '', 'C');
						$pdf->AddCol('Tid', 25, '', 'C');
						$pdf->AddCol('Dato', 25, '', 'C');
						$pdf->AddCol('Basseng', 30, '', 'C');
						$pdf->AddCol('Ansatt', 30, '', 'C');
							
						$pdf->Table("
							SELECT measurements.title as Tittel, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(VARCHAR(10),routines.date,103) as Dato, pools.name as Basseng, emps.user_name as Ansatt
							FROM routines, measure_routine, measurements, pools, emps
							WHERE routines.id = measure_routine.routine_id
							AND measure_routine.measure_id = measurements.id
							AND (measurements.title  Like 'A_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
							AND pools.name = '".$basseng."' 
							AND Date between '".$fraDato."' and '".$tilDato."'
							ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D');
				
				}
				
				
				elseif($_POST['hent'] == 'dagvakt')
				{
				
					$pdf->AddCol('Tittel', 50, '', 'C'); 
					$pdf->AddCol('Verdi', 25, '', 'C');
					$pdf->AddCol('Tid', 25, '', 'C');
					$pdf->AddCol('Dato', 25, '', 'C');
					$pdf->AddCol('Ansatt', 30, '', 'C');
										
					$pdf->Table("
						SELECT tasks.title as Tittel, routines.value as Verdi,  convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(varchar(10),routines.date, 105) as Dato, emps.user_name as Ansatt
						FROM routines, task_routine, tasks, emps
						WHERE routines.id = task_routine.routine_id
						AND task_routine.task_id = tasks.id
						AND (tasks.title  Like 'D_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
						ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D');

				}
				
				elseif($_POST['hent'] == 'kveldsvakt')
				{
				
					$pdf->AddCol('Tittel', 70, '', 'C'); 
					$pdf->AddCol('Verdi', 25, '', 'C');
					$pdf->AddCol('Tid', 25, '', 'C');
					$pdf->AddCol('Dato', 25, '', 'C');
					$pdf->AddCol('Ansatt', 30, '', 'C');
					
					
					$pdf->Table("
						SELECT tasks.title as Tittel, routines.value as Verdi,  convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(VARCHAR(10),routines.date,103) as Dato, emps.user_name as Ansatt
						FROM routines, task_routine, tasks, emps
						WHERE routines.id = task_routine.routine_id
						AND task_routine.task_id = tasks.id
						AND (tasks.title  Like 'K_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
						ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D');
				
				}
				
				elseif($_POST['hent'] == 'kontrollcm')
				{
			  
					$pdf->AddCol('Tittel', 50, '', 'C'); 
					$pdf->AddCol('Verdi', 25, '', 'C');
					$pdf->AddCol('Tid', 25, '', 'C');
					$pdf->AddCol('Dato', 25, '', 'C');
					$pdf->AddCol('Ansatt', 30, '', 'C');
				  
					$pdf->Table("
					SELECT tasks.title as Tittel, routines.value as Verdi, CONVERT(VARCHAR(10),routines.date,103) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, emps.user_name as Ansatt
					FROM routines, task_routine, tasks, emps
					WHERE routines.id = task_routine.routine_id
					AND task_routine.task_id = tasks.id
					AND (tasks.title  Like 'C_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
					ORDER BY routines.date DESC");

					$pdf->Output("$strf.pdf", 'D');
				
				}	
			  
				elseif($_POST['hent'] == 'helgevakt')
				{
			  
				$pdf->AddCol('Tittel', 75, '', 'C'); 
				$pdf->AddCol('Verdi', 25, '', 'C');
				$pdf->AddCol('Tid', 25, '', 'C');
				$pdf->AddCol('Dato', 25, '', 'C');
				$pdf->AddCol('Ansatt', 30, '', 'C');
			  
				$pdf->Table("
				SELECT tasks.title as Tittel, routines.value as Verdi, convert(VARCHAR(10), routines.time, 108) as Tid, CONVERT(VARCHAR(10),routines.date,103) as Dato, emps.user_name as Ansatt
				FROM routines, task_routine, tasks, emps
				WHERE routines.id = task_routine.routine_id
				AND task_routine.task_id = tasks.id
				AND (tasks.title  Like 'H_%') AND routines.emp_id=emps.id AND Date between '".$fraDato."' and '".$tilDato."'
				ORDER BY routines.date DESC");

				$pdf->Output("$strf.pdf", 'D');
				
			  }	
			
			
		}

		$prop=array('HeaderColor'=>array(255,150,100),
					'color1'=>array(210,245,255),
					'color2'=>array(255,255,210),
					'padding'=>2);
					
	}
?>