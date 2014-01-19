<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Búsqueda por Servicio</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/jumbotron.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy this line! -->
  <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
    </head>
<style type="text/css">


</style>
    <body>

      <br />
      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
     <?php
      include_once "header.php";
      include_once "conexion.php";
      include_once "funciones.php";
if(isset($_POST['servicio']) ){
$servicio=$_POST['servicio'];
  echo '<h3 class="media-heading">Servicio: '.$servicio.'</h3>';
 


  



//$query = "select con.*, ser.servicio from contacto con join contacto_servicio conser on con.id = conser.contacto join servicios ser on conser.servicio = ser.id join servicio ru on ser.id_servicio = ru.id where ru.nombre ='$servicio'";
$query = "select distinct (con.id), con.nombre, con.apellido, con.ci, con.email, con.telefono, con.direccion, con.observacion, ser.servicio  from contacto con 
join contacto_servicio conser on con.id = conser.contacto 
join servicios ser on conser.servicio = ser.id 
join rubro ru on ser.id_rubro = ru.id where ser.servicio = '$servicio'"; 
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
                <h3 class="panel-title"> </h3>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>