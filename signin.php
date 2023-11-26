<?php
header('X-Frame-Options: DENY');
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
    <?php
            if (isset($_COOKIE['Nombre'])) {
                echo '<p class="saludos">Hola, ' . $_COOKIE["Nombre"] . '!</p> 
                <form method="post"> <input class="botonadios" type="submit" name="botonadios" value="Cerrar Sesión?">';
            }
            ?>
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
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <br>
        <label for="nombre"><b>Nombre</b></label>
        <input type="text" name="nombre" placeholder="Ej: Carlos" onkeypress="return /[a-zA-Z\s]/i.test(event.key)">
        <br>
    <label for="apellido"><b>Apellido</b></label>
    <input type="text" name="apellido" placeholder="Ej: Sologuestoa" onkeypress="return /[a-zA-Z\s]/i.test(event.key)">
    <br>
    <label for="pw"><b>Contrase&ntilde;a</b></label>
    <input type="password" min=8 name="pw" placeholder="Ej: seguridad123 (8 car&aacute;cteres m&iacute;nimo)">
    <br>
    <label class="espaciarder64" for="dni"><b>DNI</b></label>
    <input type="text" max=10 name="dni" placeholder="12345678-A">
    <br>
    <label for="telefono"><b>Tel&eacute;fono</b></label>
    <input type="tel" max=9 name="telefono" placeholder="123456789">
    <br>
    <label class="bloquenomlargo" for="fechanac"><b>Fecha de<br>nacimiento</b></label>
    <input type="text" max=10 name="fechanac" placeholder="AAAA-MM-DD">
    <br>
    <label class="espaciarder42" for="email"><b>Email</b></label>
    <input type="email" style="text-transform: lowercase" name="email" placeholder="ejemplo@email.com">

        <input class="botongeneral" type="button" name="enviar" value="Enviar" onclick="comprobardatos()">
    </form>
    <p class="letrapequeña">¿Ya tienes cuenta?</p>
    <a class="letrapequeña" href="login.html">Inicia sesión</a>
</div>

</body>
</html>

