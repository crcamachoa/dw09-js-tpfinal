<?php
// Rutas donde tendremos la libreria y el fichero de idiomas.
require_once('tcpdf/tcpdf.php');
 
// Crear el documento
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Información referente al PDF
$pdf->SetCreator("Mauricio");
$pdf->SetAuthor('Mauricio Merin');
$pdf->SetTitle('Ejemplo');
$pdf->SetSubject('Ejemplo de Generacion de PDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// Contenido de la cabecera
$pdf->SetHeaderData("imagen1.jpg", 20, "Titulo", "Subtitulo");
 
// Fuente de la cabecera y el pie de página
$pdf->setHeaderFont(Array("times", 'B', 20));
$pdf->setFooterFont(Array("helvetica", 'I', 10));
 
// Márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Saltos de página automáticos.
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Establecer el ratio para las imagenes que se puedan utilizar
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// Establecer la fuente
$pdf->SetFont('times', 'BI', 16);
 
// Añadir página
$pdf->AddPage();
 
// Escribir una línea con el método CELL
$pdf->Cell(0, 12, 'Muestra', 1, 1, 'C');

//Generar HTML 
$html = '<br/><br/>
<div style="text-align:center;text-decoration:underline"><strong>Pago Cuota Mutual </strong></div> 
<div style="text-align:left;"> 
 <strong>Afiliado : $dni - $nombres</strong> 
</div> 
<div style="text-align:center;"> 
<table border="1"> 
<tbody><tr style="background-color: #CCCCCC"> 
<td><strong>Fecha Pago</strong></td> 
<td><strong>Mes Pagado</strong></td> 
<td><strong>Año</strong></td> 
<td><strong>Importe</strong></td> 
</tr> 
<tr style="background-color: #FFFFFF"> 
<td>$fecha</td> 
<td>$Mes</td> 
<td>$ano</td> 
<td>$importe</td> 
</tr> 
</tbody></table> 
</div> 
<div style="margin-left:75%;text-align:center;width:50px;"><strong>Firma :  
<hr style="height: 2px; margin-left: 90%; margin-right: -30%"></strong></div>';
$pdf->writeHTML($html,false,true, false);   

// ---------------------------------------------------------

//Cerramos y damos salida al fichero PDF
$pdf->Output('example_001.pdf', 'I');