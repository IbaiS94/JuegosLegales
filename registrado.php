
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
	echo "<h2>Usuario no registrado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Ha habido un problema con el registro.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}else{
$nombr=$_POST['nombre'];
$ape=$_POST['apellido'];
$pw=$_POST['pw'];
$dni=$_POST['dni'];
$tele=$_POST['telefono'];
$fechan=$_POST['fechanac'];
$email=$_POST['email'];
$q = "INSERT INTO usuarios (Nombre, Apellido, PW, DNI, Telefono, Fechanac, email) VALUES ('$nombr', '$ape', '$pw', '$dni','$tele','$fechan','$email')";
mysqli_query($dbconnect, $q);
echo "<h2>Usuario registrado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Te has registrado correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}
mysqli_close($dbconnect);
?>

</body>
</html>
