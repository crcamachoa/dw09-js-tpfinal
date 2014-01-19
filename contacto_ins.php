<?php
if (! empty ( $_POST )) {
	require_once './class/contacto.class.php';
	require_once './class/rubro.class.php';
	require_once './class/Contacto_servicio.class.php';
	
	$contacto = Contacto::singleton ();
	
	// crear variables para validar los errores
	$nombreError = null;
	$apellidoError = null;
	$ciError = null;
	$emailError = null;
	$direccionError = null;
	$telefonoError = null;
	
	
	// obtener las variables post
	$nombre 		= $_POST ['nombre'];
	$apellido 	= $_POST ['apellido'];
	$ci 				= $_POST ['ci'];
	$email 			= $_POST ['email'];
	$telefono 	= $_POST ['telefono'];
	$direccion 	= $_POST ['direccion'];
	$observacion = $_POST ['observacion'];
	
	// validar input
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
	
	if (empty ( $telefono )) {
		$telefonoError = 'Por favor ingresar Telefono';
		$valid = false;
	}
	
	if (empty ( $direccion )) {
		$direccionError = 'Por favor ingresar Direccion';
		$valid = false;
	}
	
	
	// insertar los datos
	if ($valid) {
		$contacto = Contacto::singleton ();
		$contacto->insert_contacto ( $nombre, $apellido, $ci, $email, $telefono, $direccion, $observacion );
		//$contactoId = $contacto->get_last_id(1);
include "/bd.php";
		$dbh = new PDO ( "pgsql:dbname=$dbname;host=$host;user=$user;password=$password" );
		$dbh->exec ( "SET CHARACTER SET utf8" );
		$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$dbh->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		
		try {
			$query = $dbh->prepare ( 'select id from contacto order by id desc limit 1' );
			$query->execute ();
			$dataCount = $query->fetch ();
			$dbh = null;
		} catch ( PDOException $e ) {
			$e->getMessage ();
		}
		$contactoId = $dataCount['id'];
		
		echo "<br><br><br><br> Contacto ID:" . $contactoId;
		
		$contacto_servicio = Contacto_servicio::singleton ();
		
		$rubro = Rubro::singleton ();
		$rubro_list = $rubro->get_rubros();
		
		foreach ($rubro_list as $rubro_row){
			$checkRubro = 'check_list_'.$rubro_row['id'];
			$check_list = $_POST[$checkRubro];
			if(!empty($_POST[$checkRubro])) {
				foreach($check_list as $check) {
					$contacto_servicio->asignar_servicio($contactoId,$check);
				}
			}
		}
		
		
		header ( "Location: contacto.php" );
	}
}else{
	require_once './class/rubro.class.php';
	require_once './class/servicio.class.php';
	
	$rubro = Rubro::singleton ();
	$servicio = Servicio::singleton ();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/bootstrap.js"></script>
</head>

<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
	<div class="container">

		<div class="span10 offset1">
			<form class="form-horizontal" action="contacto_ins.php" method="post">
				<fieldset>
					<legend>Crear Contacto</legend>
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
				      	<label for="city" class="col-lg-2 control-label">Nombre</label>
				       	<div class="col-lg-8">
				        	<input name="apellido" type="text" placeholder="Apellido" class="form-control" value="<?php echo !empty($apellido)?$apellido:'';?>">
				        	<?php if (!empty($apellidoError)): ?>
	              		<span class="help-inline text-danger"><?php echo $apellidoError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($emailError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Mail</label>
				       	<div class="col-lg-8">
				        	<input name="email" type="text" placeholder="Email" class="form-control" value="<?php echo !empty($email)?$email:'';?>" />
				        	<?php if (!empty($emailError)): ?>
	              		<span class="help-inline text-danger"><?php echo $emailError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($ciError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">CI</label>
				       	<div class="col-lg-8">
				        	<input name="ci" type="text" placeholder="CI" class="form-control" value="<?php echo !empty($ci)?$ci:'';?>">
				        	<?php if (!empty($ciError)): ?>
	              		<span class="help-inlin  text-danger"><?php echo $ciError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($telefonoError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Telefono</label>
				       	<div class="col-lg-8">
				        	<input name="telefono" type="text" placeholder="Telefono" class="form-control" value="<?php echo !empty($telefono)?$telefono:'';?>">
				        	<?php if (!empty($telefonoError)): ?>
	              		<span class="help-inlin  text-danger"><?php echo $telefonoError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row <?php echo !empty($direccionError)?'error':'';?>">
				      	<label for="city" class="col-lg-2 control-label">Direccion</label>
				       	<div class="col-lg-8">
				        	<input name="direccion" type="text" placeholder="Direccion" class="form-control" value="<?php echo !empty($direccion)?$direccion:'';?>">
				        	<?php if (!empty($direccionError)): ?>
	              		<span class="help-inlin  text-danger"><?php echo $direccionError;?></span>
	            		<?php endif; ?>
				        </div>
				      </div>
				      
				      <div class="form-group row">
				      	<label for="city" class="col-lg-2 control-label">Observacion</label>
				       	<div class="col-lg-8">
				       		<textarea name="observacion" class="form-control" rows="5" placeholder="Observacion"><?php echo !empty($observacion)?$observacion:'';?></textarea>
	              	<span class="help-inlin">Texto libre de observaciones</span>
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
											echo '<label class="checkbox"><input type="checkbox" name="check_list_'.$rubro_row['id'].'[]" value="'.$servicio_row['sid'].'">'. $servicio_row['sservicio'] .'</label>';
											$lineasServicio += 1;
				            }
				            
// 				            if ($lineasServicio == 0) {
// 											echo '<label class="text-warning>No tiene servicios asignado el rubro </label>"';
// 										}
				          ?>
				    		</div>
				  		</div>
				  	</div>
				  	<?php } ?>
					</div>					
				</fieldset>
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Crear</button>
					<a class="btn btn-default" href="contacto.php">Regresar</a>
				</div>
			</form>
		</div>
	</div>
	<!-- /container -->
</body>
</html>