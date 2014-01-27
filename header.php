   <div class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
      <div class="container"> 
        <div class="navbar-header"> 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
          </button> 
          <a class="navbar-brand" href="index.php">Paginas Amarillas Paraguay</a> 
        </div> 
  
         <div class="navbar-collapse collapse"> 
<?php  
error_reporting(E_ERROR | E_PARSE); 
session_start();  
  
include_once "login.php"; 
  
//Para definir que parte del menu debe estar activo, en esta lista se deben agregar las relaciones 
$rubro_list = array("list_view.php", "index.php"); //Sitios relacionados con Rubro (no de admin) 
$servicio_list = array("list_view_servicio.php", "buscaservicio.php");//Sitios relacionados con servicios (no de admin) 
$contacto_list = array("list_viewcontacto.php", "buscacontacto.php");//Sitios relacionados con contacto (no de admin) 
$editar_list = array("contacto.php", "lista_servicios.php","lista_rubros.php", "lista_usuarios.php", "edit_usuario.php", "usuarios.php", "edit_servicio.php","servicios.php", "edit_rubro.php", "rubros.php", "cambiar_pass.php" ); 
$busqueda_list = array("busqueda.php");
  
//Se obtiene la pagina actual 
$pagina_actual = basename($_SERVER['PHP_SELF']); 
  
//Se activa el boton correspondiente 
if    (in_array($pagina_actual, $rubro_list)){ 
  $activo='Rubro'; 
} 
elseif(in_array($pagina_actual, $servicio_list)){ 
  $activo='Servicio'; 
} 
elseif(in_array($pagina_actual, $contacto_list)){ 
  $activo='Contacto'; 
} 
elseif(in_array($pagina_actual, $busqueda_list)){ 
  $activo='Busqueda'; 
} 
else
  $activo='Editar'; 
if(!isset($_SESSION['nombre']) ) 
{ 
  ?> 
  
  
      <ul class="nav navbar-nav"> 
      <li <?php  if($activo == 'Rubro' )  echo 'class="active"';?>> 
          <a href="index.php">Rubro</a> 
      </li> 
     <li <?php  if($activo == 'Contacto' )  echo 'class="active"';?>> 
          <a href="buscacontacto.php">Contacto</a> 
      </li> 

      <li <?php  if($activo == 'Servicio' )  echo 'class="active"';?>> 
        <a href="buscaservicio.php">Servicio</a> 
      </li> 
     <li <?php  if($activo == 'Busqueda' )  echo 'class="active"';?>> 
          <a href="busqueda.php">Busqueda</a> 
      </li>   
      </ul> 
      
         <form class="navbar-form navbar-right" method="POST" action=""> 
            <div class="form-group"> 
              <input type="text" placeholder="Usuario" class="form-control" name="usuario"> 
            </div> 
            <div class="form-group"> 
              <input type="password" placeholder="Password" class="form-control" name="password"> 
            </div> 
            <button type="submit" class="btn btn-success">Ingresar</button> 
          </form>  
<?php 
} 
else
  { 
?> 
    <ul class="nav navbar-nav"> 
        <li <?php  if($activo == 'Rubro')  echo 'class="active"';?>> 
            <a href="index.php">Rubro</a> 
        </li> 
       <li <?php  if($activo == 'Contacto')  echo 'class="active"';?>> 
            <a href="buscacontacto.php">Contacto</a> 
        </li> 
        <li <?php  if($activo == 'Servicio')  echo 'class="active"';?>> 
            <a href="buscaservicio.php">Servicio</a> 
        </li> 
        <li <?php  if($activo == 'Busqueda')  echo 'class="active"';?>> 
            <a href="busqueda.php">Busqueda</a> 
        </li> 
         <li <?php  if($activo == 'Editar')  echo 'class="active"';?>> 
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrar</a> 
            <ul class="dropdown-menu"> 
                <li> 
                    <a href="contacto.php">Contacto</a> 
                    <a href="lista_servicios.php">Servicio</a> 
            <a href="lista_rubros.php">Rubros</a> 
            <a href="lista_usuarios.php">Usuarios</a> 
                </li> 
            </ul> 
        </li> 
      
    </ul> 
      
    <p class="navbar-text navbar-right">Bienvenido <?php echo $_SESSION['nombre']; ?></p> 
    <form action="logout.php"><button type="submit" class="btn btn-default navbar-btn navbar-right" href="logout.php">Salir</button></form> 
<?php  
  } 
?> 
        </div> 
        <!--/.navbar-collapse --> 
      </div>  
    </div>