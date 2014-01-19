<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/bootstrap.js"></script>
    <title>Crear Rubros</title>
</head>
<body>
	<?php include_once 'menu.php';?>
	<br><br><br>
	<div class="container">

		<div class="span10 offset1">
          <form class="form-horizontal" id="formulario" name="formulario" action="insertar_rubro.php" method="post" >
              <fieldset>
                            <legend>Crear Rubro</legend>
                                <div class="col-lg-10">
                                    <div class="well">
                                            
                                            <label class="col-lg-2 control-label">Rubro:</label>                                                
                                            <div class="col-lg-8">
                                                
                                                <input id="rubros" name="rubros" type="text" class="form-control" required />
                                               
                                            </div>
                                            <br />
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a class="btn btn-default" href="lista_rubros.php">Regresar</a>
                                    </div>
					           </div>
				    </fieldset>
    	       </form>
  	</div>               
  </div> <!-- /container -->
</body>
</html>