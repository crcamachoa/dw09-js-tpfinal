<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Language" content="en-us">
<title>Paginas Amarillas Paraguay</title>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/typeahead.js"></script> 
<style>
.tt-hint,.rubro  {
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

$('input.rubro').typeahead({
  name: 'rubro',
  remote : 'rubro.php?query=%QUERY'

});

})
</script>

</head>
<body>
<?php 
include_once "header.php";
 ?>
<div class="jumbotron">
        <div class="container">
        <h2>Páginas Amarillas Paraguay</h2>
        <p>Bienvenido a Páginas Amarillas Paraguay, ingrese su búsqueda.</p>
          <div class="col-lg-6">
    <div class="input-group">
<div class="content">

<form method="POST" action="list_view.php">
<input type="text" name="rubro" size="20" class="rubro" placeholder="Por favor ingrese el Rubro">
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

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>
    </div> <!-- /container -->
    
</body>
</html>

