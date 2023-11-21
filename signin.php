<?php
header('X-Frame-Options: DENV');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="scripts/comprobardatos.js"></script>
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
    <a href="login.php">Log in</a>
    <a href="signin.php">Sign in</a>
    <a href="modificardatos.php">Datos personales</a>
    <a href="about.php">About</a>
</div>

<h2>Registrarse</h2>

<div class="cajaregistro">
<form action="registrado.php" name="registro" method="post">
    <br>
    <label for="nombre"><b>Nombre</b></label>
    <input type="text" name="nombre" placeholder="Ej: Carlos">
    <br>
    <label for="apellido"><b>Apellido</b></label>
    <input type="text" name="apellido" placeholder="Ej: Sologuestoa">
    <br>
    <label for="pw"><b>Contrase&ntilde;a</b></label>
    <input type="password" name="pw" placeholder="Ej: seguridad123">
    <br>
    <label class="espaciarder64" for="dni"><b>DNI</b></label>
    <input type="text" name="dni" placeholder="12345678-A">
    <br>
    <label for="telefono"><b>Tel&eacute;fono</b></label>
    <input type="tel" name="telefono" placeholder="123456789">
    <br>
    <label class="bloquenomlargo" for="fechanac"><b>Fecha de<br>nacimiento</b></label>
    <input type="text" name="fechanac" placeholder="AAAA-MM-DD">
    <br>
    <label class="espaciarder42" for="email"><b>Email</b></label>
    <input type="email" style="text-transform: lowercase" name="email" placeholder="ejemplo@email.com">

    <input class="botongeneral" type="button" name="enviar" value="Enviar" onclick="comprobardatos()">
</form>

<p class="letrapequeña">&iquest;Ya tienes cuenta?</p>
<a class="letrapequeña" href="login.html">Inicia sesi&oacute;n</a>
</div>


</body>

</html>
