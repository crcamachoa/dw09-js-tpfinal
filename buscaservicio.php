<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Language" content="en-us">
<title>Paginas Amarillas Paraguay Busqueda por nombre y apellido</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/typeahead.js"></script> 
<style>
.tt-hint,.servicio  {
 	border: 2px solid #CCCCCC;
    border-radius: 8px 8px 8px 8px;
    font-size: 24px;
    height: 45px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 400px;
}

.tt-dropdown-menu {
  width: 400px;
  margin-top: 5px;
  padding: 8px 12px;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px 8px 8px 8px;
  font-size: 18px;
  color: #111;
  background-color: #F1F1F1;
}

</style>
<script>
$(document).ready(function() {

$('input.servicio').typeahead({
  name: 'servicio',
  remote : 'serviciosajax.php?query=%QUERY'

});

})
</script>
<?php 
include_once "header.php";
 ?>
</head>
<body>
<div class="jumbotron">
        <div class="container">
        <h2>Páginas Amarillas Paraguay</h2>
        <p>Bienvenido a Páginas Amarillas Paraguay, ingrese su búsqueda.</p>
          <div class="col-lg-6">
    <div class="input-group">
<div class="content">

<form method="POST" action="list_view_servicio.php">
<input type="text" name="servicio" size="20" class="servicio" placeholder="Por favor ingrese el Servicio">
     <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Buscar!</button>
      </span>
</form>

</div>  
</div>  
</div>
</div>
</div>
  <div class="container">
      <!-- Example row of columns -->
      <div class="row">
     
      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>
    </div> <!-- /container -->
   </div> 
</body>
</html>