<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Resultado de busquedas - Contactos</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/jumbotron.css" rel="stylesheet">


    </head>
<style type="text/css">
.contact-name {
   margin: 0 20px 5px 20px;
   padding: 3px 0;
   border-bottom: 1px solid #ccc;    
    
}  
</style>
    <body>

      <br />
      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
     <?php
      include_once "header.php";
      include_once "conexion.php";
      include_once "funciones_contacto.php";
if(isset($_POST['contacto']) ){
$contacto=$_POST['contacto'];
  echo '<h3 class="media-heading">Contacto: '.$contacto.'</h3>';
 


  



$query = "select con.*, nombre || ' ' || apellido from contacto con 
where nombre || ' ' || apellido ilike '%$contacto%'"; 
$resultSet = pg_query($conn,$query);

if(!$resultSet)
  die("Ocurrió un error al ejecutar el query");

$i=0;
while($row = pg_fetch_assoc($resultSet))
{
  $i=$i+1;
?>
 <!-- Este es un panel -->

         <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="img\map.jpg" alt="mapa">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $i.". ".$row['nombre']." ".$row['apellido'];  ?></h4>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Servicios Ofrecidos: </b><?php echo obtenerServicios($conn,$row['id']); ?></h3>
              </div>
              <div class="panel-body">
                <table >
                  <th>
                    Datos Personales
                  </th>         
                  <tr>
                   <td>Email:</td> 
                   <td><?php echo $row['email'];?></td>
                 </tr>                
                 <tr>
                  <td>Teléfono: </td> 
                  <td><?php echo $row['telefono'];?></td> 
                </tr>
                <tr>  
                  <td>Dirección: </td> 
                  <td><?php echo $row['direccion'];?></td> 
                </tr>
                <tr>
                  <td><i><?php echo $row['observacion'] ?></i> </td>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
 <!-- Este es un panel -->
<?php 
}

pg_close($conn);
}
else
header("location: index.php");
?>

 






 
<footer>

<p>&copy; Company 2013</p>
</footer>
    </div> <!-- /container -->

</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>
<?php
} else {
 header("location: index.php");
}
?>
