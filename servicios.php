<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Crear Servicios</title>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">
     
  	<div class="span10 offset1">
                <form class="form-horizontal" id="formulario" name="formulario" action="insertar_servicios.php" method="post" >
        	        <fieldset>
                            <legend>Crear Servicios</legend>
                                <div class="col-lg-10">
                                    <div class="well">
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Rubro:</label>                                                
                                            <div class="col-lg-8">
                                                <select class="form-control" name="cmb_rubro" id="cmb_rubro" >
                                                  <?php
                                                
                                                      include_once "conexion.php";
                                                     // Consulta de la Base de datos 
                                                    $resultado = pg_query("SELECT * FROM rubro ORDER BY id ASC")
                                                     or die('Consulta fallida: ' . pg_last_error());
                                                    
                                                    while($row = pg_fetch_array($resultado)) { 
                                    
                                                            $valor = $row["id"]; 
                                                            $nombre = $row["nombre"];
                                                            echo "<option value=".$valor.">".$nombre."</option>"; 
                                                    } 
                                                  ?>
                                                </select>
                                            </div>
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Servicio:</label> 
                                            <div class="col-lg-8">
                                                <input class="form-control" id="servicios" name="servicio" type="text" placeholder="Servicio" required /> 
                                            </div>
                                            </div>    
                               </div>  <!-- /well -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a class="btn btn-default" href="lista_servicios.php">Regresar</a>
                            </div>
					</div>  <!-- /col-lg-10 -->
				</fieldset>
    	</form>
  	</div>               
	</div> <!-- /container -->
</body>
</html>
