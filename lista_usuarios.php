<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!-- 	<link   href="css/bootstrap.min.css" rel="stylesheet"> -->
<!-- 	<script src="js/bootstrap.min.js"></script> -->
<!-- 	<script type="text/javascript" src="js/jquery.js"></script> -->
    <meta charset="utf-8">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript" src="js/bootstrap.js"></script> 
</head>
 
<body>
	<?php include 'menu.php'; ?>
        <br />
        <br />
        <br />
    <div class="container">
            <div class="row">
                <h3>Usuarios</h3>
            </div>
            <div class="row">
            	<p>
                	<a href="usuarios.php" class="btn btn-success">Crear</a>
                </p>
                <?php 
         include_once "conexion.php";
          
           // Consulta de la Base de datos
                                                $comando = "SELECT usuario.*, rol.nombre as desc_rol FROM usuario INNER JOIN rol ON rol.id = usuario.rol                                                             order by usuario.id";
												
                                                    $consulta = pg_query($comando);
                                                    $cant = pg_numrows($consulta); // Cantidad de líneas
                                                    print("<table class='table table-striped table-bordered'>");
                                                
                                                    // Línea de títulos
          
                                                    $linea = "<thead>";
                                                    $linea = "<tr>";                                        
                                                    $linea .= "<th>ROL</th>";
                                                    $linea .= "<th>USUARIO</th>";
                                                    $linea .= "<th>NOMBRE</th>";
                                                    $linea .= "<th>APELLIDO</th>";
                                                    $linea .= "<th>CI</th>";
                                                    //$linea .= "<th>CONTRASEÑA</th>";
                                                    $linea .= "<th>ACCIONES</th>";
                                                    $linea .= "</tr>";
                                                    $linea .= "</thead>";
                                                    print($linea);
                                                    $i = 0;
                                                    while ($i < $cant) {
                                                      // Datos de una fila
                                                      $idusuario= pg_result($consulta, $i, "id");
                                                      $usuario = pg_result($consulta, $i, "usuario");
                                                      $nombre = pg_result($consulta, $i, "nombre");
                                                      $apellido = pg_result($consulta, $i, "apellido");
                                                      $ci = pg_result($consulta, $i, "ci");
                                                      $rol = pg_result($consulta, $i, "rol");                                                     
                                                      $desc_rol = pg_result($consulta, $i, "desc_rol");
                                                      
                                                      // Despliegue de una fila
                                                      $linea = "<tbody>";
                                                      $linea = "<tr>";
                                                      $linea .= "<td>$desc_rol</td>";
                                                      $linea .= "<td>$usuario</td>";
                                                      $linea .= "<td>$nombre</td>";
                                                      $linea .= "<td>$apellido</td>";
                                                      $linea .= "<td>$ci</td>";
                                                     // $linea .= "<td>$pass</td>";
                                                      $linea .= "<td width=350><a class='btn btn-success' href='edit_usuario.php?idusuario=$idusuario&rol=$rol'>Editar</a>&nbsp;&nbsp;<a class='btn btn-danger' href='delete_usuario.php?idusuario=$idusuario'>Eliminar</a>&nbsp;&nbsp;<a class='btn btn-info' href='cambiar_pass.php?idusuario=$idusuario'>Cambiar Password</a></td>";
                                                      $linea .= "</tr>";
                                                      $linea .= "</tbody>";
                                                      print($linea);
                                                      $i++;
                                                    }
                                                    print("</table>");
																									
													pg_close();
          
                                ?> 
<br />
      <p>&copy; Company 2013</p>
      </div>      
    </div> <!-- /container -->
  </body>
</html>