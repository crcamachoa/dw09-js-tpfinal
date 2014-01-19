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
    <div class="container">
        <br />
        <br />
        <br />
            <div class="row">
                <h3>Servicios</h3>
            </div>
            <div class="row">
            	<p>
                	<a href="servicios.php" class="btn btn-success">Crear</a>
                </p>
                <?php 
         include_once "conexion.php";
          
           // Consulta de la Base de datos
                                                $comando = "select servicios.id, servicio, nombre, id_rubro from servicios inner join rubro
                                                            on id_rubro = rubro.id order by nombre";
												
                                                    $consulta = pg_query($comando);
                                                    $cant = pg_numrows($consulta); // Cantidad de líneas
                                                    print("<table class='table table-striped table-bordered'>");
                                                
                                                    // Línea de títulos
          
                                                    $linea = "<thead>";
                                                    $linea = "<tr>";                                        
                                                    $linea .= "<th>SERVICIO</th>";
                                                    $linea .= "<th>RUBRO</th>";
                                                    $linea .= "<th>ACCIONES</th>";
                                                    $linea .= "</tr>";
                                                    $linea .= "</thead>";
                                                    print($linea);
                                                    $i = 0;
                                                    while ($i < $cant) {
                                                      // Datos de una fila
                                                      $idservicio= pg_result($consulta, $i, "id");
                                                      $servicio = pg_result($consulta, $i, "servicio");
                                                      $rubro = pg_result($consulta, $i, "nombre");
                                                      $idrubro = pg_result($consulta, $i, "id_rubro");
                                                      
                                                      // Despliegue de una fila
                                                      $linea = "<tbody>";
                                                      $linea = "<tr>";
                                                      $linea .= "<td> $servicio</td>";
                                                      $linea .= "<td> $rubro </td>";                                                     
                                                      $linea .= "<td width=250><a class='btn btn-success' href='edit_servicio.php?idservicio=$idservicio&idrubro=$idrubro'>Editar</a>&nbsp;&nbsp;<a class='btn btn-danger' href='delete_servicio.php?idservicio=$idservicio'>Eliminar</a></td>";
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