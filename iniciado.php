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
	echo "<h2>Usuario no identificado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Ha habido un problema con la identificación.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}else{
$user=$_POST['nombre'];
$pw=$_POST['pw'];

$q = "Select * from usuarios WHERE Nombre='".$user."' AND PW='".$pw."'" ;
$qDNI = "Select DNI from usuarios WHERE Nombre='".$user."' AND PW='".$pw."'" ;
$dame = mysqli_fetch_assoc(mysqli_query($dbconnect, $qDNI));
$resultado=mysqli_query($dbconnect, $q);
if(mysqli_num_rows($resultado)==1){
setcookie("IdentComo",$dame['DNI'],time()+10000);
echo "<h2>Usuario identificado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Te has identificado correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}
}
mysqli_close($dbconnect);
?>

</body>
</html>
