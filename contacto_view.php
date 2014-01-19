<?php
    require_once './class/contacto.class.php';
		require_once './class/rubro.class.php';
		require_once './class/servicio.class.php';
		require_once './class/contacto_servicio.class.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: contacto.php");
    } else {
    	$contacto = Contacto::singleton();
    	$contacto 				 = Contacto::singleton ();
    	$contacto_servicio = Contacto_servicio::singleton ();
    	$rubro 						 = Rubro::singleton ();
    	$servicio 				 = Servicio::singleton ();
    	
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
	<?php include_once 'menu.php';?>
	<br><br><br>
    <div class="container">
    	<div class="panel panel-default">
    	
    	<div class="panel-heading">
      	<h3>Visualizar Contacto</h3>
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
			  <div class="form-group">
			    <label class="col-sm-2 control-label">telefono</label>
			    <div class="col-sm-10">
			      <label class="checkbox text-muted">
            	<?php echo $data['telefono'];?>
            </label>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-2 control-label">Direccion</label>
			    <div class="col-sm-10">
			      <label class="checkbox text-muted">
            	<?php echo $data['direccion'];?>
            </label>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-2 control-label">Observacion</label>
			    <div class="col-sm-10">
			      <label class="checkbox text-muted">
            	<?php echo $data['observacion'];?>
            </label>
			    </div>
			  </div>
			  <br />
			  
			  <legend>Rubros y Servicios</legend>
					<div class="col-lg-10">
						<?php
							$rubro_list = $rubro->get_rubros();
				    	foreach($rubro_list as $rubro_row){
								$servicio_list = $servicio->get_servicio_rubro($rubro_row['id']);
								$lineasServicio = 0;
								$printRubro = false;
				        foreach($servicio_list as $servicio_row){
									if (!$printRubro) {
										echo '<div class="well">
								  					<div class="control-group check_boxes optional servicio_content_type">
								  						<label class="check_boxes optional control-label">Rubro: '. $rubro_row['nombre'] .'</label>
								  							<div class="controls">';
										$printRubro = true;
									}
									$contacto_servicio_exist = $contacto_servicio->get_contacto_servicio_check($id,$servicio_row['sid']);
									if ($contacto_servicio_exist['existe'] == 1){
										echo '<label class="checkbox">'. $servicio_row['sservicio'] .'</label>';
									}
									$lineasServicio += 1;
				        }
				        if($printRubro){
				        echo '</div>
				  							</div>
				  								</div>';
				        }
				  		} ?>
					</div>
					
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <div class="form-actions">
            	<a class="btn btn-default" href="contacto.php">Regresar</a>
            	<a class="btn btn-default" href="contacto_pdf.php?id=<?php echo $data['id']; ?>">PDF</a>
            </div>
			    </div>
			  </div>
			</div>
			</div>          
    </div> <!-- /container -->
  </body>
</html>
