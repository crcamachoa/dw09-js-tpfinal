<?php  
include_once "conexion.php";  
if (isset($_REQUEST['query'])) { 
$query = $_REQUEST['query']; 
$sql = pg_query($conn,"SELECT * FROM contacto WHERE nombre ILIKE '%{$query}%' OR apellido ILIKE '%{$query}%' "); 
$array = array(); 
while ($row = pg_fetch_assoc($sql)) { 
$array[] = trim($row['nombre']) . ' ' . trim($row['apellido']);
} 
echo json_encode ($array); //Return the JSON Array 
} 
?>