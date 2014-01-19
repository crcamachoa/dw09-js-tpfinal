<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Editar Rubro</title>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">     
  	<div class="span10 offset1">
                  <form class="form-horizontal" id="formulario" name="formulario" action="actualizar_rubros.php" method="post">
                      <fieldset>
                            <legend>Editar Rubro</legend>
                                <div class="col-lg-10">
                                    <div class="well">
                                            <?php
                                                
                                            $idrubro = $_GET['idrubro'];
                                            ?>
                                            <label class="col-lg-2 control-label">Rubro:</label>                                                
                                            <div class="col-lg-8">
                                                <?php    
                                                    include_once "conexion.php";
                                                         // Consulta de la Base de datos 
                                                    $resultado = pg_query("SELECT nombre FROM rubro WHERE id=$idrubro")
                                                     or die('Consulta fallida: ' . pg_last_error());
                                    
                                                    while($row = pg_fetch_array($resultado)) { 
                                    
                                                            
                                                            $rubro = $row["nombre"];
                                                    }
                                                 ?> 
                                                <input id="rubro" name="rubro" type="text" class="form-control" value="<?php echo $rubro ?>" required />
                                                <input type="hidden" name="idrubro" id="idrubro" value="<?php echo $idrubro; ?>" />
                                            </div>
                                            <br />
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <a class="btn btn-default" href="lista_rubros.php">Regresar</a>
                                    </div>
					           </div>
				    </fieldset>
    	       </form>
  	</div>               
  </div> <!-- /container -->
</body>
</html>
<?php
} else {
 header("location: lista_rubros.php");
}
?>