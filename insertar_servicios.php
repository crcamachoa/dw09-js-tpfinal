<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario


      
  $servicio= $_POST['servicio'];
  $rubro = $_POST['cmb_rubro'];
     

 
///Conectamos a la DB
 
include_once "conexion.php";

// Insercion de los datos recibido del formulario
      
	  $comando = "INSERT INTO servicios (servicio, id_rubro)";
	  
      $comando .= "VALUES ('$servicio', $rubro)";
      if (pg_query($comando)) {
		
       		header("location: lista_servicios.php");
	   

	  }

      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo solo puede funcionar si es llamado desde un <i>FORM</i>");

    }
?>