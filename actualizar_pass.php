
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Datos del formulario

  $idusuario = $_POST['idusuario'];
  $oldpass = md5($_POST["currentPassword"]);
  $newpass = md5($_POST["newPassword"]);
    
    

    include_once "conexion.php";
         // Consulta de la Base de datos 
    $resultado = pg_query("SELECT * FROM usuario where id=$idusuario")
     or die('Consulta fallida: ' . pg_last_error());

    while($row = pg_fetch_array($resultado)) { 

            $pass = $row["password"];
    }


        if($oldpass == $pass) {
       
        $update = "UPDATE usuario set password='$newpass' WHERE id=$idusuario";
        
              
                if (pg_query($update)) {
                                        
                                        
                echo "<html></head><script type='text/javascript'> window.onload = function () {  window.location.href='lista_usuarios.php' } </script> </head><body></body></html>";
                              
                        
                                
                pg_close();
                //}else{

                  //      echo "Fallo la actualizacion" . pg_last_error();
                }
        }

    
      
}else{
// Mensaje de error
        print ("ERROR: Este archivo sólo puede funcionar si es llamado desde un <i>FORM</i>");

}
?>