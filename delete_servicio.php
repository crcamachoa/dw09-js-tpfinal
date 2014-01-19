<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {



// Datos del formulario


$idservicio= $_GET['idservicio'];

            	        
	   
///Conectamos a la DB
 
include_once "conexion.php";

// Inserción de los datos recibido del formulario

$delete = "DELETE 
		   FROM servicios
		   WHERE id=$idservicio";
     
	  
      if (pg_query($delete)) {
			
			
			
       		echo "<html></head><script type='text/javascript'> window.onload = function () {  window.location.href='lista_servicios.php' } </script> </head><body></body></html>";
	   
      }

 pg_close();
      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo sólo puede funcionar si es llamado desde un <i>FORM</i>");

    }
?>