<?php
header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';");

session_start();

// Generar un token CSRF si no está definido
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generar un token aleatorio
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        exit();
    }

    // Procesamiento del formulario...
} else {
    // Manejo de otra solicitud o redirección si es necesario
}
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

</body>

</html>
