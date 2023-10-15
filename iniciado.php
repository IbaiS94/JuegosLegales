<?php
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
}
$user=$_POST['nombre'];
$pw=$_POST['pw'];

$q = "Select * from usuarios WHERE Nombre='".$user."' AND PW='".$pw."'" ;
$resultado=mysqli_query($dbconnect, $q);
if(mysqli_num_rows($resultado)==1){
echo "identificado";}

?>
