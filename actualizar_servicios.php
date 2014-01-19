<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario

      
  $servicio= $_POST['servicio'];
  $rubro = $_POST['cmb_rubro'];
  $idservicio = $_POST['idservicio'];
      
	   
///Conectamos a la DB
 
include_once "conexion.php";

// Inserción de los datos recibido del formulario

$update = "UPDATE servicios SET servicio='$servicio', id_rubro=$rubro
WHERE id=$idservicio";
     
	  
if (pg_query($update)) {
			
			
       		echo "<html></head><script type='text/javascript'> window.onload = function () {  window.location.href='lista_servicios.php' } </script> </head><body></body></html>";
	   
	   
    
         pg_close();
 }    
      
  } else {
// Mensaje de error
        print ("ERROR: Este archivo sólo puede funcionar si es llamado desde un <i>FORM</i>");

}
?>