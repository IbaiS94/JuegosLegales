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
$apellido=$_POST['apellido'];
$dni=$_POST['dni'];
$tel=$_POST['telefono'];
$fechan=$_POST['fechanac'];
$email=$_POST['email'];
$pwold=$_POST['pass'];
$pnew=$_POST['pass2'];
$dniviejo=$_COOKIE["IdentComo"];
$qcontra = "Select * from usuarios WHERE DNI='".$dniviejo."'" ;
$rcontra=mysqli_fetch_assoc(mysqli_query($dbconnect, $qcontra));
if(strcmp($rcontra["PW"],$pwold)==0){
$qupdate = "UPDATE usuarios SET Nombre='".$user."', Apellido='".$apellido."', DNI='".$dni."', Telefono='".$tel."', Fechanac='".$fechan."', email='".$email."', PW='".$pnew."' WHERE DNI='".$dniviejo."'";
echo "Se ha actualizado su informacion, gracias por usar nuestros servicios";
mysqli_query($dbconnect, $qupdate);
}
else{
echo "LA CONTRASEÑA INTRODUCIDA ES INCORRECTA QUE ANDAS";}
?>
