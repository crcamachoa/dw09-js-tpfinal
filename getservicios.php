<?php
     
      include_once "conexion.php";
      include_once "funciones.php";



	
	// set MIME type
	header("Content-type: application/json");
	if($_GET["servicio"]!="todos")
	{
	$servicio = $_GET["servicio"];

	$query = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, con.telefono, con.direccion, con.observacion, ser.servicio  from contacto con 
join contacto_servicio conser on con.id = conser.contacto 
join servicios ser on conser.servicio = ser.id 
join rubro ru on ser.id_rubro = ru.id where ser.id=$servicio" ;
	}
	else{
$query = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, con.telefono, con.direccion, con.observacion, ser.servicio  from contacto con 
join contacto_servicio conser on con.id = conser.contacto 
join servicios ser on conser.servicio = ser.id 
join rubro ru on ser.id_rubro = ru.id" ;
	} 
$resultSet = pg_query($conn,$query);
	// -----------< construimos nuestra nhembo base de datos >-------------------//

	
	$fakeDB = array();
	//--------------------------------------------------------------------------//
	
	// Obtenemos el parámetro
while($row = pg_fetch_assoc($resultSet))
{
    array_push($fakeDB, $row);
}	
	// output JSON
    print(json_encode($fakeDB));
?>