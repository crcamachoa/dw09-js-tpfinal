<?php
require_once './class/contacto.class.php';

function make_seed()
{
	list($usec, $sec) = explode(' ', microtime());
	return (float) $sec + ((float) $usec * 100000);
}
srand(make_seed());
$randval = rand();

$id = null;
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ( null==$id ) {
	header("Location: contacto.php");
} else {
	$contacto = Contacto::singleton();
	$data = $contacto->get_contacto($id);
}

$nombre   = trim($data['nombre']);
$apellido = trim($data['apellido']);
$ci 	  = trim($data['ci']);
$email 	  = trim($data['email']);


    $content = "
<page>
    <h1>Sistema de Paginas Amarillas</h1>
    <br>
    <b>Datos del Contacto: $id</b>
    <br><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>NOMBRE</u>: $nombre</p>
    <br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>APELLIDO</u>: $apellido</p>
    <br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>CI:</u> $ci</p>
    <br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<u>CORREO:</u> $email</p>
    <br>
</page>";

    require_once('html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $archivo = "contacto_$id-$randval.pdf";
    $html2pdf->Output('exemple.pdf');
?>

