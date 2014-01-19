<?php
$datosEntrada = $_POST['nombre'];
//primero avisamos al navegador que espere como respuesta contenido xml
header("Content-type: text/xml");

//luego hacemos control de errores
//controlamos que hayan datos
//en el input de entrada
//este control DEBERIA ser en el cliente ANTES
//de mandar la solicitud
//sin embargo lo hacemos asi solo a fines de demostracion
if(empty($datosEntrada)){
	//generamos el xml de respuesta
	//version
	//y con formato de 
	//options
		//option CADA ITEM fin option
	//fin options
	echo '<?xml version="1.0"?>';
	echo '<options>';
		echo'<option>';
			echo'No hay datos de entrada!';
		echo'</option>';
	echo '</options>';
}
else{
	//nos conectamos a la bd
	$coneccion = pg_connect("host=localhost dbname=ricardo port=5432 user=postgres password=postgres")
		or die('No pudo conectarse: ' . pg_last_error());
	
		//hacemos el query
	//$resultado = pg_query("select nombre from rubro where nombre LIKE '".$datosEntrada."%'")
		$resultado = pg_query("select nombre from rubro")
		or die('Consulta fallida: ' . pg_last_error());
	
	//definimos el tipo de respuesta que enviaremos
	//y generamos el xml en base a la respuesta del servidor
		echo '<?xml version="1.0"?>';
		echo '<options>';
		while ($datos = pg_fetch_array($resultado, null, PGSQL_ASSOC))
		{
			echo '<option>';
			echo $datos['nombre'];
			echo '</option>';
		}
		echo '</options>';
}
?>
