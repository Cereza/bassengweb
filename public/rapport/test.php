
<?php

$timezone = "Europe/Oslo";
 date_default_timezone_set($timezone);
 $format="%H%M%S";
$strf=strftime($format);


/*******EDIT LINES 3-8*******/

require ('connection.php');
$filename = "$strf";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   

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
SELECT measurements.title as Tittel, routines.value as Verdi, CONVERT(VARCHAR(10),routines.date,105) as Dato, convert(VARCHAR(10), routines.time, 108) as Tid, pools.name as Basseng, emps.user_name as Ansatt
FROM routines, measure_routine, measurements, pools, emps
WHERE routines.id = measure_routine.routine_id
AND measure_routine.measure_id = measurements.id
AND (measurements.title  Like 'T_%') AND measure_routine.pool_id=pools.id AND routines.emp_id=emps.id 
AND pools.name = '$basseng' 
AND Date between '".$fraDato."' and '".$tilDato."'
ORDER BY routines.date, routines.time;
";

}

 

// $Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
//$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
 $result=sqlsrv_query($conn,$sql) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno()); 

   
$file_ending = "xls";
$reals=array();
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < sqlsrv_num_fields($result); $i++) {
    $type = mysql_field_type($result,$i);
    echo mysql_field_name($result,$i) . "\t";
    if ($type == "real")
    {
        $reals[] = $i;
    }
}

print("\n");    
//end of printing column names  
//start while loop to get data
while($row = mysql_fetch_row($result))
{
    $schema_insert = "";
    for($j=0; $j<sqlsrv_num_fields($result);$j++)
    {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != ""){
            if (in_array($j, $reals)){
                $schema_insert .= str_replace(".",",","$row[$j]").$sep;
            } else {
                $schema_insert .= "$row[$j]".$sep;
            }
        }
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
} 
 
 }
 }
?>