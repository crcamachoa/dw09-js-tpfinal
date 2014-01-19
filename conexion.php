<?php 
include "bd.php";
$conn = pg_connect("host=$host dbname=$dbname port=$port user=$user password=$password")
or die('No pudo conectarse: ' . pg_last_error());
if (!$conn) die ("No se pudo conectar a la base de datos");

?>