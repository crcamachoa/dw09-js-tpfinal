<?php 
include_once "conexion.php"; 
if (isset($_REQUEST['query'])) {
$query = $_REQUEST['query'];
$sql = pg_query($conn,"SELECT * FROM servicios WHERE servicio ILIKE '%{$query}%'");
//$sql = mysql_query ("SELECT * FROM country WHERE country LIKE '%{$query}%'");
$array = array();
while ($row = pg_fetch_assoc($sql)) {
$array[] = trim($row['servicio']);
}
echo json_encode ($array); //Return the JSON Array
}
?>