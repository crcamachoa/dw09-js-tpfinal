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
            <div class="row">
                <h3>Contactos</h3>
            </div>
            <div class="row">
            	<p>
                	<a href="contacto_ins.php" class="btn btn-success">Crear</a>
                </p>
                <table class="table table-striped table-bordered">
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
                  	<?php
					require_once 'class/contacto.class.php';
					$contactos = Contacto::singleton();
					$data = $contactos->get_contactos();
					 
					/* Obtener el total de registros */
					$cantidad = $contactos->count();
					
					 
					if (isset($_GET{'page'})) { //get the current page
						$page = $_GET{'page'} + 1;
						//$offset = $rec_limit * $page;
					} else {
						// show first set of results
						$page = 0;
						//$offset = 0;
					}
					//$left_rec = $rec_count - ($page * $rec_limit);
					
					//we loop through each records
					while ($row = $contactos->get_contactos_page($page)) {
					 
					//populate and display results data in each row
					echo '<tr>';
					echo '<td>' . $row['employee_id'] . '</td>';
					echo '<td>' . $row['LAST_NAME'] . '</td>';
					echo '<td>' . $row['FIRST_NAME'] . '</td>';
					echo '<td>' . $row['EMAIL'] . '</td>';
					echo '<td>' . $row['salary'] . '</td>';
					 
					}
					 
					echo '</tr>';
					echo '</tbody>';
					echo '</table>';
					//we display here the pagination
					echo '<ul class="pager">';
					if ($left_rec < $rec_limit) {
					$last = $page - 2;
					echo @"<li><a href=\"$_PHP_SELF?page=$last\">Previous</a></li>";
					} else if ($page == 0) {
					echo @"<li><a href=\"$_PHP_SELF?page=$page\"> <li>Next</a></li>";
					} else if ($page > 0) {
					$last = $page - 2;
					echo @"<li><a href=\"$_PHP_SELF?page=$last\">Previous</a></li> ";
					echo @"<li><a href=\"$_PHP_SELF?page=$page\">Next</a></li>";
					}
					echo '</ul>';
					mysql_close($conn);
					?>
					</tbody>
                  <tbody>
                  <?php
		            foreach($data as $fila){
		            	echo '<tr>';
		            	echo '<td>'. $fila['id'] . '</td>';
		            	echo '<td>'. $fila['nombre'] . '</td>';
		            	echo '<td>'. $fila['apellido'] . '</td>';
		            	echo '<td>'. $fila['email'] . '</td>';
		            	echo '<td>'. $fila['ci'] . '</td>';
		            	echo '<td width=250>';
		            	echo '<a class="btn btn-default" href="contacto_view.php?id='.$fila['id'].'">Ver</a>';
		            	echo ' ';
		            	echo '<a class="btn btn-success" href="contacto_edit.php?id='.$fila['id'].'">Editar</a>';
		            	echo ' ';
		            	echo '<a class="btn btn-danger" href="contacto_delete.php?id='.$fila['id'].'">Borrar</a>';
		            	echo '</td>';
		            	echo '</tr>';
		            	
		            	//set up mysql connection
		            	$dbhost = 'localhost';
		            	$dbuser = 'root';
		            	$dbpass = '';
		            	//number of results to show per page
		            	$rec_limit = 3;
		            	
		            	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		            	if (!$conn) {
		            		die('Could not connect: ' . mysql_error());
		            	}
		            	//select database
		            	mysql_select_db('oracledbm');
		            	/* Get total number of records */
		            	$sql = "SELECT count(employee_id) FROM employees ";
		            	$retval = mysql_query($sql, $conn);
		            	if (!$retval) {
		            		die('Could not get data: ' . mysql_error());
		            	}
		            	
		            	$row = mysql_fetch_array($retval, MYSQL_NUM);
		            	$rec_count = $row[0];
		            	
		            	if (isset($_GET{'page'})) { //get the current page
		            		$page = $_GET{'page'} + 1;
		            		$offset = $rec_limit * $page;
		            	} else {
		            		// show first set of results
		            		$page = 0;
		            		$offset = 0;
		            	}
		            	$left_rec = $rec_count - ($page * $rec_limit);
		            	//we set the specific query to display in the table
		            	$sql = "SELECT employee_id, LAST_NAME, FIRST_NAME, EMAIL, salary " . "FROM employees " . "LIMIT $offset, $rec_limit";
		            	
		            	$retval = mysql_query($sql, $conn);
		            	if (!$retval) {
		            		die('Could not get data: ' . mysql_error());
		            	}
		            	//we loop through each records
		            	while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
		            	
		            		//populate and display results data in each row
		            		echo '<tr>';
		            		echo '<td>' . $row['employee_id'] . '</td>';
		            		echo '<td>' . $row['LAST_NAME'] . '</td>';
		            		echo '<td>' . $row['FIRST_NAME'] . '</td>';
		            		echo '<td>' . $row['EMAIL'] . '</td>';
		            		echo '<td>' . $row['salary'] . '</td>';
		            	
		            	}
		            	
		            	echo '</tr>';
		            	echo '</tbody>';
		            	echo '</table>';
		            	//we display here the pagination
		            	echo '<ul class="pager">';
		            	if ($left_rec < $rec_limit) {
		            		$last = $page - 2;
		            		echo @"<li><a href=\"$_PHP_SELF?page=$last\">Previous</a></li>";
		            	} else if ($page == 0) {
		            		echo @"<li><a href=\"$_PHP_SELF?page=$page\"> <li>Next</a></li>";
		            	} else if ($page > 0) {
		            		$last = $page - 2;
		            		echo @"<li><a href=\"$_PHP_SELF?page=$last\">Previous</a></li> ";
		            		echo @"<li><a href=\"$_PHP_SELF?page=$page\">Next</a></li>";
		            	}
		            	echo '</ul>';
		            	mysql_close($conn);
		            	?>
		            }
		          ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>