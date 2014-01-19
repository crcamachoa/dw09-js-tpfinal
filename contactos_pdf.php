<?php
require_once './class/contacto.class.php';

function make_seed()
{
	list($usec, $sec) = explode(' ', microtime());
	return (float) $sec + ((float) $usec * 100000);
}
srand(make_seed());
$randval = rand();

	$contacto = Contacto::singleton();
	$data = $contacto->get_contactos();

    $content = "
<page>
    <h1>Sistema de Paginas Amarillas</h1>
    <br>";
    foreach($data as $fila){
    	$id				= trim($fila['id']);
    	$nombre   = trim($fila['nombre']);
    	$apellido = trim($fila['apellido']);
    	$ci 	  = trim($fila['ci']);
    	$email 	  = trim($fila['email']);
    
    $content .= "<br><br>
    <b>Datos del Contacto: $id</b>
    <br><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>NOMBRE</u>: $nombre</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>APELLIDO</u>: $apellido</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>CI:</u> $ci</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>CORREO:</u> $email</p>";
    }
 $content .= "</page>";

    require_once('html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $archivo = "contacto_$id-$randval.pdf";
    $html2pdf->Output('exemple.pdf');
?>

