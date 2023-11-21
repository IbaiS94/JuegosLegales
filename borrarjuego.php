<?php
header('X-Frame-Options: DENV');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';");

session_start();

// Generar un token CSRF si no está definido
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generar un token aleatorio
    setcookie('csrf_token', $_SESSION['csrf_token'], time() + 3600, '/', 'dominio.com', false); // Modifica 'dominio.com' según tu configuración

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
<title>Juegos Legales</title>
<link rel="stylesheet" href="styles.css">
<!--<link rel="icon" type="image/x-icon" href="skullspining.png">-->
</head>

<body>
<div class="toptitle">
<img src="images/skullspining.png" alt="skull" style="float:left;">
<img src="images/skullspining.png" alt="skull" style="float:right;">
<h1>Juegos Legales</h1>
</div>

<!-- <h3>La legalidad es lo primero</h3> -->

<div class="topmenu">
    <a href="index.php">Home</a>
    <a href="juegos.php">Juegos</a>
    <a href="login.php">Log in</a>
    <a href="signin.php">Sign in</a>
    <a href="about.php">About</a>
</div>

<h2>Borrar juego</h2>
        
<div class="cajaborrado">
    <form action="borrando.php" name="borrar" method="post">
        <br>
        <?php
                /*include 'juegos.php';*/
                /*$nom = $nombre;*/
                $nomjuego = strip_tags(htmlspecialchars($_POST['Nombre'], ENT_QUOTES, 'UTF-8'));
                echo "<br>";
                echo "¿Seguro que quieres borrar el juego '";
                echo $nomjuego;
                echo "'?<br><br>";
            ?>
            

       <input type='hidden' name='nom' value=" <?php echo $nomjuego; ?> ">
       <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input class="botongeneral" type="submit" name="borrar" value="Borrar">
    </form>
</div>
</body>
</html>

