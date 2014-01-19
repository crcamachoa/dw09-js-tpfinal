<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Editar Servicios</title>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">
      <?php                         
        $idservicio = $_GET['idservicio'];
        $idrubro = $_GET['idrubro'];
       ?>
      
  	<div class="span10 offset1">
                  <form class="form-horizontal" name="formulario" action="actualizar_servicios.php" method="post">
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
                                                                    $descripcion = $row["nombre"];
                                                                    if ((isset($valor)) && ($valor == $idrubro)) {
                                                                    echo "<option value=".$valor." selected=\"selected\">".$descripcion."</option>";
                                                                    }else{
                                                                    echo "<option value=".$valor.">".$descripcion."</option>"; 
                                                                    }
                                                            }
                                                                         
                                                        ?>
                                                </select>
        			                         </div>
                                             </div>
        		
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Servicio:</label>                                                
                                            <div class="col-lg-8">
                                                    <?php    
                                                        include_once "conexion.php";
                                                             // Consulta de la Base de datos 
                                                        $resultado = pg_query("SELECT servicio FROM servicios WHERE id=$idservicio")
                                                         or die('Consulta fallida: ' . pg_last_error());
                                        
                                                        while($row = pg_fetch_array($resultado)) { 
                                        
                                                                
                                                                $servicio = $row["servicio"];
                                                        }
                                                    ?>          
                                            
                                                <input class="form-control" id="servicio" name="servicio" type="text" value="<?php echo $servicio ?>" required />
                                                <input type="hidden" name="idservicio" id="idservicio" value="<?php echo $idservicio; ?>" />        			
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
<?php
} else {
 header("location: lista_servicios.php");
}
?>