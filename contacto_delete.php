<?php
    require_once './class/contacto.class.php';
    $contacto = Contacto::singleton();
    $id = 0;
     
    if ( !empty($_GET['id'])) {
    	//obtener id get
        $id = $_REQUEST['id'];
        //obtener el contacto a eliminar
        $data = $contacto->get_contacto($id);
    }
     
    if ( !empty($_POST)) {
        // obtener id post
        $id = $_POST['id'];
         
        // Eliminar Contacto
        $contacto->delete_contacto($id);
        header("Location: contacto.php");
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
</head>
 
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
  <div class="container">   
  	<div class="span10 offset1">
	    <form class="form-horizontal" action="contacto_delete.php" method="post">
	    	<div class="col-lg-10">
					<div class="well">
			    	<input type="hidden" name="id" value="<?php echo $id;?>"/>
			      <p class="alert alert-danger">Estas seguro de Eliminar el Contacto!</p>
			      <div class="form-group">
					    <label class="col-sm-2 control-label">Nombre</label>
					    <div class="col-sm-10">
					      <label class="checkbox text-muted">
		            	<?php echo $data['nombre'];?>
		            </label>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Apellido</label>
					    <div class="col-sm-10">
					      <label class="checkbox text-muted">
		            	<?php echo $data['apellido'];?>
		            </label>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					      <label class="checkbox text-muted">
		            	<?php echo $data['email'];?>
		            </label>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">CI</label>
					    <div class="col-sm-10">
					      <label class="checkbox text-muted">
		            	<?php echo $data['ci'];?>
		            </label>
					    </div>
					  </div>
			      
			      <div class="form-actions">
			      	<button type="submit" class="btn btn-danger">Si</button>
			        <a class="btn btn-default" href="contacto.php">No</a>
			      </div>
			    </div>
			  </div>
      </form>
    </div>                 
  </div>
</body>
</html>