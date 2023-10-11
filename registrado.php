<?php
$host = "localhost";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
}
$nombr=$_POST['nombre'];
$ape=$_POST['apellido'];
$pw=$_POST['pw'];
$dni=$_POST['dni'];
$tele=$_POST['telefono'];
$fechan=$_POST['fechanac'];
$email=$_POST['email'];
$q = "INSERT INTO usuarios (Nombre, Apellido, PW, DNI, Telefono, Fechanac, email) VALUES ('$nombr', '$ape', '$pw', '$dni','$tele','$fechan','$email')";
mysqli_query($dbconnect, $q);
echo "<a href='index.html' class='enlacecentral'>Volver a juegos</a>";
?>
