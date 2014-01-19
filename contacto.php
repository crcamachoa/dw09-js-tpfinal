<?php
require_once 'class/contacto.class.php';
$contactos = Contacto::singleton();
$data = $contactos->get_contactos();

$rec_limit = $contactos->getRowPage(); //obtener lineas por pagina
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!-- 	<link   href="css/bootstrap.min.css" rel="stylesheet"> -->
<!-- 	<script src="js/bootstrap.min.js"></script> -->
<!-- 	<script type="text/javascript" src="js/jquery.js"></script> -->
  <meta charset="utf-8">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
 
<body>
	<?php include 'menu.php'; ?>
    <div class="container">
    		<br><br><br>
            <div class="row">
                <h3>Contactos</h3>
            </div>
            <div class="row">
              <p>
              	<a href="contacto_ins.php" class="btn btn-success">Crear</a>
                <a href="contactos_pdf.php" class="btn btn-default">Exportar a PDF</a>
              </p>
                <table id="tableFilter" class="table table-striped table-bordered">
<!--                 <table id="tableFilter" class="table table-striped table-hover table-condensed"> -->
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>APELLIDO</th>
                      <th>EMAIL</th>
                      <th>CI</th>
                      <th>ACCION</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php         
				            /* Obtener el total de registros */
				            //$cantidad = $contactos->count_where();
                  	$cantidad = $contactos->count();
				            $cantidad = $cantidad['cantidad'];
				            
				            if (isset($_GET{'page'})) { //get the current page
				            	$page = $_GET{'page'};
				            } else {
				            	// show first set of results
				            	$page = 1;
				            }
	            	
				            $data = $contactos->get_contactos_page($page - 1);
				            //$data = $contactos->get_contactos_where_page($where,$page - 1);
				            $total_pag = ceil($cantidad / $rec_limit);
				            
				            if ($page > $total_pag){
				            	header("Location: $_PHP_SELF?page=$total_pag");
				            }
				            
				            foreach($data as $fila){
												echo '<tr>';
												echo '<td>'. $fila['id'] . '</td>';
												echo '<td>'. $fila['nombre'] . '</td>';
												echo '<td>'. $fila['apellido'] . '</td>';
												echo '<td>'. $fila['email'] . '</td>';
												echo '<td>'. $fila['ci'] . '</td>';
												echo '<td width=260>';
												echo '<a class="btn btn-default" href="contacto_view.php?id='.$fila['id'].'">Ver</a>';
												echo ' ';
												echo '<a class="btn btn-success" href="contacto_edit.php?id='.$fila['id'].'">Editar</a>';
												echo ' ';
												echo '<a class="btn btn-danger" href="contacto_delete.php?id='.$fila['id'].'">Borrar</a>';
												echo ' ';
												echo '<a class="btn btn-default" href="contacto_pdf.php?id='.$fila['id'].'">PDF</a>';
												echo '</td>';
												echo '</tr>';
										}
				            
				            echo '</tr>';
				            echo '</tbody>';
				            echo '</table>';
				            echo "<div class=\"text-center\">";
				            //empieza paginacion
				            $page = ($page == 0 ? 1 : $page);
				            $prev = ($page == 1 ? 1 : $page - 1);
				            $next = ($next == $total_pag ? $total_pag : $page + 1);
				            echo '<ul id="paginacion" class="pagination">';				            
				            if(!($page == 1)){
				            	echo "<li><a href=\"$_PHP_SELF?page=1\"><<</a></li>";
				            	echo "<li><a href=\"$_PHP_SELF?page=$prev\"><</a></li>";
				            }
				            
				            $i = ($page <= ($total_pag - 2) ? $page - 3 : ($page - 3) - ($page == $total_pag ? 2 : 1) );
				            $print = 1;
				            while ($print <= 5){
				            	$i += 1;
				            	if($page == $i){
				            		echo "<li class=\"active\"><a href=\"$_PHP_SELF?page=$i\">$i <span class=\"sr-only\">(current)</span></a></li>";
				            		$print += 1;
				            	}elseif($i>0){
												echo "<li><a href=\"$_PHP_SELF?page=$i\">$i</a></li>";
												$print += 1;
				            	}
				            	$print = ($i >= $total_pag ? 99 : $print);
				            }
				            if(!($page > ($total_pag - 1)) ){
				            	echo "<li><a href=\"$_PHP_SELF?page=$next\">></a></li>";
				            	echo "<li><a href=\"$_PHP_SELF?page=$total_pag\">>></a></li>";
				            }
				            echo '</ul>';
				            echo '</div>';
				          ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>