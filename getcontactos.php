<?php
    require_once "class/contacto_servicio.class.php";
    $contactos = Contacto_servicio::singleton();

    // set MIME type
	header("Content-type: application/json");
    
    //comprobamos si han llegado las variables get para setearlas
    $limit = !isset($_GET["limit"]) || $_GET["limit"] == "undefined" ? 3 : $_GET["limit"];
    $offset = !isset($_GET["offset"]) || $_GET["offset"] == "undefined" ? 0 : $_GET["offset"];
    $servicio = !isset($_GET["servicio"]) || $_GET["servicio"] == "undefined" ? "todos" : $_GET["servicio"];
    $busqueda = !isset($_GET["busqueda"]) || $_GET["busqueda"] == "undefined" ? "" : $_GET["busqueda"];

    // Ejecuta consulta y regresa el resultado
    $datos  = $contactos->getContactosPorServicio($servicio, $offset, $limit, $busqueda);
    $links = $contactos->crea_links($servicio, $busqueda);

    //$resultado = $array("data" => $data,"links" => $links)

    $resultado['datos'] = $datos;
    $resultado['links'] = $links;

	// output JSON
    echo json_encode($resultado);
?>
