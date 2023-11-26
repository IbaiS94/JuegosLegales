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
<script type="text/javascript" src="scripts/comprobar2.js"></script>
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>

<body>

<div class="toptitle">
<img src="images/skullspining.png" alt="skull" style="float:left;">
<img src="images/skullspining.png" alt="skull" style="float:right;">
<h1>Juegos Legales</h1>
 <?php if (isset($_COOKIE['Nombre'])) {
                echo '<p class="saludos">Hola, ' . $_COOKIE["Nombre"] . '!</p> 
                <form method="post"> <input class="botonadios" type="submit" name="botonadios" value="Cerrar Sesión?"> </form>';
            } ?>
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
$galletita = $_COOKIE["IdentComo"];
//$sameip = "SELECT MAX(logins.Time), IP1 FROM logins WHERE Correcto = 1 AND DNI IN ( SELECT DNI FROM usuarios WHERE galletita = '".$galletita."')";
$q500 = "SELECT MAX(logins.Time) AS max_time, IP1 FROM logins WHERE Correcto = 1 AND DNI IN ( SELECT DNI FROM usuarios WHERE galletita = ?)";
$declaracion = $dbconnect->prepare($q500);
$declaracion->bind_param("s", $galletita);
$declaracion->execute();
$resultado = $declaracion->get_result();
$rSameip = $resultado->fetch_assoc();
$declaracion->close();

//$rSameip = mysqli_fetch_assoc(mysqli_query($dbconnect, $sameip)); 
if(mysqli_query($dbconnect, $sq) && $rSameip['IP1'] == $_SERVER['REMOTE_ADDR'] ){
if($galletita != 'CADUCADA'){
//$q = "SELECT * FROM usuarios WHERE galletita='" . $galletita . "'";
//$r = mysqli_fetch_assoc(mysqli_query($dbconnect, $q));
$q = "Select * from usuarios WHERE galletita=?";
$stmt = $dbconnect->prepare($q);
$stmt->bind_param("s",$galletita);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombd,$apebd,$pwbd,$dnibd,$telbd,$fechanacbd,$emailbd,$cookiebd);
$stmt->fetch();
//if($r==NULL){
}}
else{
echo "<script type='text/javascript'>alert('Parece que su sesión ha caducado, vuelva a iniciar sesión');</script>";
}

echo '<div class="cajamoddatos">
    <form action="update.php" name="update" method="post">
        <br>
        <label for="nombre"><b>Nombre</b></label>
        <input type="text" value="' .$nombd. '" name="nombre" placeholder="Ej: Carlos">
        <br>
    <label for="apellido"><b>Apellido</b></label>
    <input type="text" value="'.$apebd.'" name="apellido" placeholder="Ej: Sologuestoa">
    <br>
    <label class="espaciarder64" for="dni"><b>DNI</b></label>
    <input type="text" value="'.$dnibd.'" name="dni" placeholder="12345678-A">
    <br>
    <label for="telefono"><b>Tel&eacute;fono</b></label>
    <input type="tel" value="'.$telbd.'" name="telefono" placeholder="123456789">
    <br>
    <label class="bloquenomlargo" for="fechanac"><b>Fecha de<br>nacimiento</b></label>
    <input type="text" value="'.$fechanacbd.'" name="fechanac" placeholder="01-01-0001">
    <br>
    <label class="espaciarder42" for="email"><b>Email</b></label>
    <input type="email" value="'.$emailbd.'" name="email" placeholder="ejemplo@email.com">
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
$stmt->close();
?>

</body>
</html>
