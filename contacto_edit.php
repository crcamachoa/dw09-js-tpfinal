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
    }
    $contacto 				 = Contacto::singleton ();
    $contacto_servicio = Contacto_servicio::singleton ();
    $rubro 						 = Rubro::singleton ();
    $servicio 				 = Servicio::singleton ();
    if ( !empty($_POST)) {
    	echo '<br /><br /><br /><br /><br /><br />';
    	
        // crear variables para validar los errores
			$nombreError = null;
			$apellidoError = null;
			$ciError = null;
			$emailError = null;
			$telefonoError = null;
			$direccionError = null;
			
	        // obtener las variables post
			$nombre   	 = $_POST['nombre'];
			$apellido 	 = $_POST['apellido'];
			$ci 	  		 = $_POST['ci'];
			$email 	  	 = $_POST['email'];
			$telefono 	 = $_POST['telefono'];
			$direccion 	 = $_POST['direccion'];
			$observacion = $_POST['observacion'];
	         
	        // validate input
		    $valid = true;
			if (empty ( $nombre )) {
				$nombreError = 'Por favor ingresar nombre';
				$valid = false;
			}
			
			if (empty ( $apellido )) {
				$apellidoError = 'Por favor ingresar apellido';
				$valid = false;
			}
			
			if (empty ( $ci )) {
				$ciError = 'Por favor ingresar ci';
				$valid = false;
			}
			
			if (empty ( $email )) {
				$emailError = 'Por favor ingresar email';
				$valid = false;
			} else if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
				$emailError = 'Por favor ingrese un email valido';
				$valid = false;
			}
			
			if (empty ( $telefono)) {
				$telefonoError = 'Por favor ingresar telefono';
				$valid = false;
			}
			if (empty ( $direccion )) {
				$direccionError = 'Por favor ingresar direccion';
				$valid = false;
			}
         
      // update data
      if ($valid) {
      	$contacto->update_contacto($id,$nombre,$apellido,$ci,$email,$telefono,$direccion,$observacion);

      	$contacto_servicio->vaciar_contacto_servicio($id);
      	
      	$rubro = Rubro::singleton ();
      	$rubro_list = $rubro->get_rubros();
      	
      	foreach ($rubro_list as $rubro_row){
      		$checkRubro = 'check_list_'.$rubro_row['id'];
      		$check_list = $_POST[$checkRubro];
      		if(!empty($_POST[$checkRubro])) {
      			foreach($check_list as $check) {
      				$contacto_servicio->asignar_servicio($id,$check);
      			}
      		}
      	}
      	
        header("Location: contacto.php");
      }
    } else {
        $data = $contacto->get_contacto($id);
        $nombre   	 = trim($data['nombre']);
        $apellido 	 = trim($data['apellido']);
        $ci 	  		 = trim($data['ci']);
        $email 	  	 = trim($data['email']);
        $telefono 	 = trim($data['telefono']);
        $direccion 	 = trim($data['direccion']);
        $observacion = trim($data['observacion']);
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
  		<form class="form-horizontal" action="contacto_edit.php?id=<?php echo $id?>" method="post">
	  		<fieldset>
					<legend>Editar Contacto</legend>
					<div class="col-lg-10">
				  	<div class="well">
				    	<div class="form-group row <?php echo !empty($nombreError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Nombre</label>
				       	<div class="col-lg-8">
				        	<input name="nombre" type="text" class="form-control" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>" />
				        	<?php if (!empty($nombreError)): ?>
	              		<span class="help-inline  text-danger"><?php echo $nombreError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				
				      <div class="form-group row <?php echo !empty($apellidoError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Apellido</label>
				       	<div class="col-lg-8">
				        	<input name="apellido" type="text" class="form-control" placeholder="Apellido" value="<?php echo !empty($apellido)?$apellido:'';?>">
				        	<?php if (!empty($apellidoError)): ?>
                  	<span class="help-inline  text-danger"><?php echo $apellidoError;?></span>
                  <?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($emailError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Email</label>
				       	<div class="col-lg-8">
				        	<input name="email" type="text" class="form-control" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
				        	<?php if (!empty($emailError)): ?>
                  	<span class="help-inline  text-danger"><?php echo $emailError;?></span>
                  <?php endif;?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($ciError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">CI</label>
				       	<div class="col-lg-8">
				        	<input name="ci" type="text" class="form-control" placeholder="CI" value="<?php echo !empty($ci)?$ci:'';?>">
                  <?php if (!empty($ciError)): ?>
                  	<span class="help-inline  text-danger"><?php echo $ciError;?></span>
                  <?php endif;?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($telfonoError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Telefono</label>
				       	<div class="col-lg-8">
				        	<input name="telefono" type="text" class="form-control" placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                  <?php if (!empty($telfonoError)): ?>
                  	<span class="help-inline  text-danger"><?php echo $telfonoError;?></span>
                  <?php endif;?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($direccionError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Direccion</label>
				       	<div class="col-lg-8">
				        	<input name="direccion" type="text" class="form-control" placeholder="Direccion" value="<?php echo !empty($direccion)?$direccion:'';?>">
                  <?php if (!empty($direccionError)): ?>
                  	<span class="help-inline  text-danger"><?php echo $direccionError;?></span>
                  <?php endif;?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($observacionError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Observacion</label>
				       	<div class="col-lg-8">
				       		<textarea name="observacion" class="form-control" rows="5" placeholder="Observacion"><?php echo !empty($observacion)?$observacion:'';?></textarea>
                  <span class="help-inline">Modifique texto libre de Observacion</span>
				        </div>
				      </div>
				    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Rubros y Servicios</legend>
					<div class="col-lg-10">
						<?php
							$rubro_list = $rubro->get_rubros();
				    	foreach($rubro_list as $rubro_row){
						?>
				  	<div class="well">
				  		<div class="control-group check_boxes optional servicio_content_type">
				  			<label class="check_boxes optional control-label">Rubro: <?php echo $rubro_row['nombre'] ?></label>
				  			<div class="controls">
				    			<?php
				    				$servicio_list = $servicio->get_servicio_rubro($rubro_row['id']);
				    				$lineasServicio = 0;
				            foreach($servicio_list as $servicio_row){
											$contacto_servicio_exist = $contacto_servicio->get_contacto_servicio_check($id,$servicio_row['sid']);
											if ($contacto_servicio_exist['existe'] == 0){
												echo '<label class="checkbox"><input type="checkbox" name="check_list_'.$rubro_row['id'].'[]" value="'.$servicio_row['sid'].'">'. $servicio_row['sservicio'].'</label>';
											}else{
												echo '<label class="checkbox"><input type="checkbox" name="check_list_'.$rubro_row['id'].'[]" value="'.$servicio_row['sid'].'" checked>'. $servicio_row['sservicio'].'</label>';
											}
											$lineasServicio += 1;
				            }
				          ?>
				    		</div>
				  		</div>
				  	</div>
				  	<?php } ?>
					</div>					
				</fieldset>
				<div class="form-actions">
          		<button type="submit" class="btn btn-success">Guardar</button>
            	<a class="btn btn-default" href="contacto.php">Regresar</a>
          	</div>
    	</form>
  	</div>               
	</div> <!-- /container -->
</body>
</html>
