<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="scripts/comprobar2.js"></script>
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>

<body>

<div class="toptitle">
<img src="images/skullspining.png" alt="skull" style="float:left;">
<img src="images/skullspining.png" alt="skull" style="float:right;">
<h1>Juegos Legales</h1>
</div>

<div class="topmenu">
    <a href="index.php">Home</a>
    <a href="juegos.php">Juegos</a>
    <a href="login.html">Log in</a>
    <a href="signin.html">Sign in</a>
    <a href="modificardatos.php">Datos personales</a>
    <a href="about.html">About</a>
</div>

<?php
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
	echo "<h2>Usuario no actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>No se han podido actualizar tus datos.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
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
echo "<h2>Usuario actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Se han actualizado tus datos correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
mysqli_query($dbconnect, $qupdate);
}
else{
echo "<h2>Usuario no actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>La contraseña introducida es incorrecta</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}
mysqli_close($dbconnect);
?>

</body>
</html>
