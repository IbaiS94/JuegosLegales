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

<h2>Modificar datos</h2>
<?php
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
}
$galletita = $_COOKIE["IdentComo"];
$q = "Select * from usuarios WHERE DNI='".$galletita."'";
$r=mysqli_fetch_assoc(mysqli_query($dbconnect, $q));
echo '<div class="cajamoddatos">
<form action="update.php" name="update" method="post">
    <br>
    <label for="nombre"><b>Nombre</b></label>
    <input type="text" value="'.$r["Nombre"].'" name="nombre" placeholder="Ej: Carlos">
    <br>
    <label for="apellido"><b>Apellido</b></label>
    <input type="text" value="'.$r["Apellido"].'" name="apellido" placeholder="Ej: Sologuestoa">
    <br>
    <label class="espaciarder64" for="dni"><b>DNI</b></label>
    <input type="text" value="'.$r["DNI"].'" name="dni" placeholder="12345678-A">
    <br>
    <label for="telefono"><b>Tel&eacute;fono</b></label>
    <input type="tel" value="'.$r["Telefono"].'" name="telefono" placeholder="123456789">
    <br>
    <label class="bloquenomlargo" for="fechanac"><b>Fecha de<br>nacimiento</b></label>
    <input type="text" value="'.$r["Fechanac"].'" name="fechanac" placeholder="01-01-0001">
    <br>
    <label class="espaciarder42" for="email"><b>Email</b></label>
    <input type="email" style="text-transform: lowercase" value="'.$r["email"].'" name="email" placeholder="ejemplo@email.com">
    <br>
    <label class="bloquenomlargo" for="pass"><b>Contrase&ntilde;a<br>vieja</b></label>
    <input type="password" name="pass">
    <br>
    <label class="bloquenomlargo" for="pass2"><b>Contrase&ntilde;a<br>nueva</b></label>
    <input type="password" name="pass2">

    <input class="botongeneral" type="button" name="enviar" value="Enviar" onclick="comprobar2()">
</form>';
mysqli_close($dbconnect);
?>
</div>


</body>

</html>
