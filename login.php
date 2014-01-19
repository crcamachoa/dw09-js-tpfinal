<?php 
include_once "conexion.php";
//session_start();
if(isset($_POST['usuario']) && isset($_POST['password']) ){

	

$usuario=$_POST['usuario'];
$pass=md5($_POST['password']);
$query = "select * from usuario where usuario='$usuario' and password='$pass'";
$resultSet = pg_query($conn,$query);

if(!$resultSet)
	die("Ocurrió un error al ejecutar el query");

if($row = pg_fetch_assoc($resultSet))
{
	$_SESSION['nombre']=$row['nombre']." ".$row['apellido'];


}
else{
    
	//echo "<spam style='color:red;'>Usuario Incorrecto!</spam>";
    
    echo "<spam style='color:red; float: right; text-shadow: 5px 5px 5px #FF0000;'>Usuario Incorrecto!</spam>";

}
pg_close($conn);
}
 ?>