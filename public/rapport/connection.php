<?php
//This file is for database connection for rapport and diagram
$conn_array = array (
	"UID" => "bad",
	"PWD" => "bad og plask",
	"Database" => "nih_bw",
);

$conn = sqlsrv_connect('nihsrv10-46' , $conn_array);

?>