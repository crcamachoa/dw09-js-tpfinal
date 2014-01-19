<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$id = $_GET['idusuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Cambiar Clave</title>

    
<script type="text/javascript">     
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "Campo Requerido";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "Campo Requerido";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "Campo Requerido";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "La clave no coincide";
output = false;
} 	
return output;
}
</script>    
    
    
    
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
                <form class="form-horizontal" name="frmChange" method="post" action="actualizar_pass.php" onSubmit="return validatePassword()">
                    <fieldset>
                            <legend>Cambiar Clave</legend>
                                <div class="col-lg-10">
                                    <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                    <div class="well">
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Clave Anterior:</label>                                            
                                            <div class="col-lg-8">
                                                  <input type="password" name="currentPassword" class="form-control" /><span id="currentPassword"  class="required"></span>    
                                            </div>
                                            </div>    
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Nueva Clave:</label>                                            
                                            <div class="col-lg-8">
                                                <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $id; ?>" />     
                                                <input type="password" name="newPassword" class="form-control" /><span id="newPassword"  class="required"></span>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Confirmar Nueva Clave:</label>                                      
                                            <div class="col-lg-8">
                                                <input type="password" name="confirmPassword" class="form-control" /><span id="confirmPassword" class="required"></span>
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