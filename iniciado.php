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
$qDNI = "Select DNI from usuarios WHERE Nombre='".$user."' AND PW='".$pw."'" ;
$dame = mysqli_fetch_assoc(mysqli_query($dbconnect, $qDNI));
$resultado=mysqli_query($dbconnect, $q);
if(mysqli_num_rows($resultado)==1){
setcookie("IdentComo",$dame['DNI'],time()+10000);
echo "identificado";}

?>
