<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Crear Usuarios</title>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">
     
  	<div class="span10 offset1">
                <form class="form-horizontal" id="formulario" name="formulario" action="insertar_usuarios.php" method="post" >
        	        <fieldset>
                            <legend>Crear Usuarios</legend>
                                <div class="col-lg-10">
                                    <div class="well">
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Rol:</label>                                                
                                            <div class="col-lg-8">
                                                <select class="form-control" name="cmb_rol" id="cmb_rol" >
                                                  <?php
                                                
                                                      include_once "conexion.php";
                                                     // Consulta de la Base de datos 
                                                    $resultado = pg_query("SELECT * FROM rol ORDER BY id ASC")
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
                                            <label class="col-lg-2 control-label">Usuario:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required /> 
                                            </div>
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Nombre:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre" required /> 
                                            </div>
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Apellido:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="apellido" name="apellido" type="text" placeholder="Apellido" required /> 
                                            </div> 
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">CI:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="ci" name="ci" type="number" placeholder="Documento de Identidad" required /> 
                                            </div>
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Password:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="pass" name="pass" type="password" placeholder="Contraseña" required /> 
                                            </div>
                                            </div>    
                                    </div>  <!-- /well -->
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                                <a class="btn btn-default" href="lista_usuarios.php">Regresar</a>
                                            </div>
                            </div>  <!-- /col-lg-10 -->                                 
                </fieldset>
        </form>
    </div>               
 </div> <!-- /container -->
</body>
</html>
