<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Editar Usuarios</title>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">
    <?php               
    $idusuario = $_GET['idusuario']; 
    $rol = $_GET['rol']; 
    ?>   
  	<div class="span10 offset1">
                <form class="form-horizontal" id="formulario" name="formulario" action="actualizar_usuario.php" method="post" >
        	        <fieldset>
                            <legend>Editar Usuarios</legend>
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
                                                            $descripcion = $row["nombre"];
                                                            if ((isset($valor)) && ($valor == $rol)) {
                                                            echo "<option value=".$valor." selected=\"selected\">".$descripcion."</option>";
                                                            }else{
                                                            echo "<option value=".$valor.">".$descripcion."</option>"; 
                                                            }
                                                    }
                                                                 
                                                ?>
                                                </select>
                                            </div>
                                            </div>                                            
                                            <?php    
                                                include_once "conexion.php";
                                                     // Consulta de la Base de datos 
                                                $resultado = pg_query("SELECT * FROM usuario WHERE id=$idusuario")
                                                 or die('Consulta fallida: ' . pg_last_error());
                                
                                                while($row = pg_fetch_array($resultado)) { 
                                
                                                        
                                                        $usuario = $row["usuario"];
                                                        $idusuario = $row["id"];
                                                        $nombre = $row["nombre"];
                                                        $apellido = $row["apellido"];
                                                        $ci = $row["ci"];
                                                        
                                                        
                                                }
                                            ?>        			                     
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Usuario:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="usuario" name="usuario" type="text" value="<?php echo $usuario ?>" required />
                                                <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario; ?>" />        			
                                            </div>
                                            </div>        			                     
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Nombre:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $nombre ?>" required />                      			
                                            </div>
                                            </div>        			                     
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Apellido:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $apellido ?>" required />    	
                                            </div>
                                            </div>        			                     
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">CI:</label>                                                
                                            <div class="col-lg-8">
                                                <input class="form-control" id="ci" name="ci" type="number" value="<?php echo $ci ?>" required />          			
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
<?php
} else {
 header("location: lista_usuarios.php");
}
?>