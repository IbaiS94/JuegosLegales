<?php
session_start();
header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self' test.mailsite.com; script-src 'self'; style-src 'self'; img-src 'self';");
if(isset($_POST['botonadios'])) { 
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
$sql = "UPDATE usuarios
        SET galletita = 'CADUCADA'
        WHERE galletita = ?";
$preparar = $dbconnect->prepare($sql);
$preparar->bind_param('s', $_COOKIE['IdentComo']);
$preparar->execute();
$preparar->close();
            setcookie("IdentComo", "", time()-3000);
            setcookie("Nombre", "", time()-3000);
 mysqli_close($dbconnect);
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; form-action 'self'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self' https://apis.google.com;">
<title>Juegos Legales</title>
<link rel="stylesheet" href="styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
<!--<link rel="icon" type="image/x-icon" href="skullspining.png">-->
</head>

<body>
<div class="toptitle">
<img src="images/skullspining.png" alt="skull" style="float:left;">
<img src="images/skullspining.png" alt="skull" style="float:right;">
<h1>Juegos Legales</h1>
<?php
            if (isset($_COOKIE['Nombre'])) {
                echo '<p class="saludos">Hola, ' . $_COOKIE["Nombre"] . '!</p> 
                <form method="post"> <input class="botonadios" type="submit" name="botonadios" value="Cerrar Sesión?">';
            }
            ?>
</div>

<!-- <h3>La legalidad es lo primero</h3> -->

<div class="topmenu">
    <a href="index.php">Home</a>
    <a href="juegos.php">Juegos</a>
    <a href="login.php">Log in</a>
    <a href="signin.php">Sign in</a>
    <a href="modificardatos.php">Datos personales</a>
    <a href="about.php">About</a>
</div>


<h2>Creadores</h2>
<div class="cajatextogrande">
<br>
<b>Luken Bilbao</b> <br>
<img src="images/luken.gif" style="width:300px;height:200px;">
<p>Erudito de la programaci&oacute;n, estructuraci&oacute;n y dise&ntilde;o de p&aacute;ginas web avanzadas.</p>
<br>
<b>Ibai Sologuestoa</b> <br>
<img src="images/flashbang.gif"style="width:300px;height:200px;">
<p>Maestro conocedor de la historia escrita y programador de famosos juegos como "Hundir La Flota".</p>
<br>
<b>Unai Garc&iacute;a</b> <br>
<img src="images/unai.gif"style="width:300px;height:200px;">
<p>Prodigio dise&ntilde;ador y administrador de grandes y peque&ntilde;as bases de datos, as&iacute; como antiguo pupilo de la maestra "Pollo".</p>
<br>
<br>
<br>
<br>
<br>
<br>
<p class="letrapequeña">&#59;&#41;</p>
</div>
</body>

</html>
