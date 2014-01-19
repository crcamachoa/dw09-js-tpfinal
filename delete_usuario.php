<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {



// Datos del formulario


$idusuario= $_GET['idusuario'];

            	        
	   
///Conectamos a la DB
 
include_once "conexion.php";

// Inserción de los datos recibido del formulario

$delete = "DELETE 
		   FROM usuario
		   WHERE id=$idusuario";
     
	  
      if (pg_query($delete)) {
			
			
			
       		echo "<html></head><script type='text/javascript'> window.onload = function () {  window.location.href='lista_usuarios.php' } </script> </head><body></body></html>";
	   
      }

 pg_close();
      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo sólo puede funcionar si es llamado desde un <i>FORM</i>");

    }
?>