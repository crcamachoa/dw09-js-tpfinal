<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario


      
$usuario= $_POST['usuario'];
$rol = $_POST['cmb_rol'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$ci= $_POST['ci'];
$pass= $_POST['pass'];
  

 
///Conectamos a la DB
 
include_once "conexion.php";

// Insercion de los datos recibido del formulario
    
    
	  $comando = "INSERT INTO usuario (usuario, nombre, apellido, ci, rol, password)";
	  
      $comando .= "VALUES ('$usuario', '$nombre', '$apellido', $ci, $rol, md5('$pass'))";
    //    $comando .= "VALUES ('$usuario', '$nombre', '$apellido', $ci, $rol,'$pass')";
      if (pg_query($comando)) {
		
       		header("location: lista_usuarios.php");
	   

	  }

      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo solo puede funcionar si es llamado desde un <i>FORM</i>");

    }
?>