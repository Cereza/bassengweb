<?php
//This file is for database connection for rapport and diagram
$conn_array = array (
	"UID" => "",
	"PWD" => "",
	"Database" => "nih_bw",
);

$conn = sqlsrv_connect('' , $conn_array);

?>
