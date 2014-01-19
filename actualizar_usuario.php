<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario

   
$usuario = $_POST["usuario"];
$idusuario = $_POST["idusuario"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ci = $_POST["ci"];
$rol = $_POST['cmb_rol'];
      
	   
///Conectamos a la DB
 
include_once "conexion.php";

// Inserción de los datos recibido del formulario

$update = "UPDATE usuario SET usuario='$usuario', nombre='$nombre', apellido='$apellido', ci=$ci, rol=$rol
WHERE id=$idusuario";
     
	  
if (pg_query($update)) {
			
			
       		echo "<html></head><script type='text/javascript'> window.onload = function () {  window.location.href='lista_usuarios.php' } </script> </head><body></body></html>";
	   
	   
    
         pg_close();
 }    
      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo sólo puede funcionar si es llamado desde un <i>FORM</i>");

}
?>