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
?>

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
    <a href="login.php">Log in</a>
    <a href="signin.php">Sign in</a>
    <a href="modificardatos.php">Datos personales</a>
    <a href="about.php">About</a>
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
$sq = "UPDATE usuarios
SET galletita = 'CADUCADA'
WHERE DNI IN (
    SELECT DNI
    FROM logins
    WHERE Correcto = 1
    GROUP BY DNI
    HAVING TIMESTAMPDIFF(SECOND, MAX(logins.Time), NOW()) > 3000
);
";
if(mysqli_query($dbconnect, $sq)){

$galletita = $_COOKIE["IdentComo"];
$q = "SELECT * FROM usuarios WHERE galletita='" . $galletita . "'";
$r = mysqli_fetch_assoc(mysqli_query($dbconnect, $q));
if($r==NULL){
echo "<script type='text/javascript'>alert('Parece que su sesión ha caducado, vuelva a iniciar sesión');</script>";
}
}

echo '<div class="cajamoddatos">
    <form action="update.php" name="update" method="post">
        <br>
        <label for="nombre"><b>Nombre</b></label>
        <input type="text" value="' . $r["Nombre"] . '" name="nombre" placeholder="Ej: Carlos">
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
    <input type="email" value="'.$r["email"].'" name="email" placeholder="ejemplo@email.com">
    <br>
    <label class="bloquenomlargo" for="pass"><b>Contrase&ntilde;a<br>vieja</b></label>
    <input type="password" name="pass">
    <br>
    <label class="bloquenomlargo" for="pass2"><b>Contrase&ntilde;a<br>nueva</b></label>
    <input type="password" name="pass2">
        <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
        <input class="botongeneral" type="submit" name="enviar" value="Enviar">
    </form>
</div>';

mysqli_close($dbconnect);
?>

</body>
</html>
