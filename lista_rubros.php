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
                <h3>Rubros</h3>
            </div>
            <div class="row">
            	<p>
                	<a href="rubros.php" class="btn btn-success">Crear</a>
                </p>
                <?php 
         include_once "conexion.php";
          
           // Consulta de la Base de datos
                                                $comando = "select * from rubro order by id";
												
                                                    $consulta = pg_query($comando);
                                                    $cant = pg_numrows($consulta); // Cantidad de líneas
                                                    print("<table class='table table-striped table-bordered'>");
                                                
                                                    // Línea de títulos
          
                                                    $linea = "<thead>";
                                                    $linea = "<tr>";
                                                    $linea .= "<th>ID</th>";
                                                    $linea .= "<th>RUBRO</th>";
                                                    $linea .= "<th>ACCIONES</th>";
                                                    $linea .= "</tr>";
                                                    $linea .= "</thead>";
                                                    print($linea);
                                                    $i = 0;
                                                    while ($i < $cant) {
                                                      // Datos de una fila
                                                      $idrubro= pg_result($consulta, $i, "id");                                                      
                                                      $rubro = pg_result($consulta, $i, "nombre");
                                                      
                                                      
                                                      // Despliegue de una fila
                                                      $linea = "<tbody>";
                                                      $linea = "<tr>";
                                                      $linea .= "<td> $idrubro </td>";  
                                                      $linea .= "<td> $rubro </td>";                                                     
                                                      $linea .= "<td width=250><a class='btn btn-success' href='edit_rubro.php?idrubro=$idrubro'>Editar</a>&nbsp;&nbsp;<a class='btn btn-danger' href='delete_rubro.php?idrubro=$idrubro'>Eliminar</a></td>";
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