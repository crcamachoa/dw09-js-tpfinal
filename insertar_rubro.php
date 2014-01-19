<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario



  $rubro = $_POST['rubros'];
     

 
///Conectamos a la DB
 
include_once "conexion.php";

// Insercion de los datos recibido del formulario
      
	  $comando = "INSERT INTO rubro (nombre)";
	  
      $comando .= "VALUES ('$rubro')";
      if (pg_query($comando)) {
		
       		header("location: lista_rubros.php");
	   

	  }

      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo solo puede funcionar si es llamado desde un <i>FORM</i>");

    }
?>