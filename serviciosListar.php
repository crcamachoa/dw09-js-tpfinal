<?php
require_once 'class/servicio.class.php';
$servicios = Servicio::singleton();

echo json_encode($servicios->get_servicios());
?>