<?php

//This file is for database connection for rapport and diagram
$conn_array = array (
	"UID" => "bad",
	"PWD" => "bad og plask",
	"Database" => "nih_bw",
);

date_default_timezone_set('Europe/Oslo');
$date = strftime ('%Y-%m-%d'); 
$time = strftime('%H:%M:%S');
  
 
$value = $_GET['Temp'];

$conn = sqlsrv_connect('nihsrv10-46' , $conn_array);

$sql = "Insert into routines (date, time, value, emp_id)  values ('$date', '$time', '$value', (SELECT id FROM emps WHERE first_name='Arduino'))";


if (sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
}

$query = sqlsrv_query( $conn, $sql);
if( $query === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$sql2 = "Insert into measure_routine (routine_id, measure_id, pool_id) values ((Select top 1 id from routines order by id DESC), (Select id from measurements where title='A_Auto_Temperatur'), '1' )";

$stmt = sqlsrv_query( $conn, $sql2);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

if( $query && $stmt ) {
     sqlsrv_commit( $conn );
     echo "Transaction committed.<br />";
} else {
     sqlsrv_rollback( $conn );
     echo "Transaction rolled back.<br />";
}



?>