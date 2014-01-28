<?php
    require_once "class/contacto_servicio.class.php";

    // set MIME type
	header("Content-type: application/json");

	$contactos = Contacto_servicio::singleton();
    $servicio = (isset($_GET["servicio"]) ? $_GET["servicio"] : "todos");

    // Ejecuta consulta y regresa el resultado
    $data = $contactos->getContactosPorServicio($servicio);

	// output JSON
    print(json_encode($data));
?>