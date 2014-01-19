<?php
    require_once './class/contacto.class.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
    	$contacto = Contacto::singleton();
      $data = $contacto->get_contacto($id);
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
	<br><br><br>
    <div class="container">
    	
    	<div class="panel panel-default">
    	
    	<div class="panel-heading">
      	<h2>Sistema de Paginas Amarillas</h2> 
      	<br>
      	<h2><span class="label label-primary">Contacto</span></h2>
      </div>
      
    	<div class="form-horizontal">
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
			</div>
			</div>          
    </div> <!-- /container -->
  </body>
</html>
