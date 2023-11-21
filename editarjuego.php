<?php
header('X-Frame-Options: DENV');
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
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="scripts/comprobardatos.js"></script>
    <script type="text/javascript" src="scripts/comprobardatosjuego.js"></script>
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
        <a href="about.php">About</a>
    </div>

    <?php
        $nom = strip_tags(htmlspecialchars($_POST['Nombre'], ENT_QUOTES, 'UTF-8'));
        $username = 'juegosacceso';
        $password = 'admin';
        $host = 'db';
        $db = 'juegos';
        $conn = mysqli_connect($host, $username, $password, $db) or die("No se pudo conectar con la base de datos.");
        $resultado2 = mysqli_query($conn, "SELECT * FROM juegosAnadidos WHERE Nombre='".$nom."'"); 
        $resultado = mysqli_fetch_assoc($resultado2);
        $nomjuego = htmlspecialchars($resultado['Nombre'], ENT_QUOTES, 'UTF-8');
        $desajuego = htmlspecialchars($resultado['Desarrollador'], ENT_QUOTES, 'UTF-8');
        $puntujuego = htmlspecialchars($resultado['Puntuacion']);
        $genjuego = htmlspecialchars($resultado['Genero']);
        $anojuego = htmlspecialchars($resultado['Ano']);
        $linkjuego = htmlspecialchars($resultado['Link']);
    ?>

    <h2>Editar juego</h2>
    <div class="cajaregistro">
        <form action="http://localhost:8000/editando.php" name="formulario" method="POST"> 
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <br>
            <label for="nombre"><b>Nombre</b></label>
            <input type="text" name="nombre" value="<?php echo $nomjuego; ?>" placeholder="Ej: Super Mario Bros">
            <br>
            <label for="desa"><b>Desarrollador</b></label>
            <input type="text" name="desa" value="<?php echo $desajuego; ?>" placeholder="Ej: Nintendo">
            <br>
            <label for="puntu"><b>Puntuaci&oacute;n</b></label>
            <input type="number" name="puntu" value="<?php echo $puntujuego; ?>" max=10 min=0 placeholder="Ej: 9.5">
            <br>
            <label for="gen"><b>G&eacute;nero</b></label>
            <select name="gen" id="gen">
                <option value="<?php echo $genjuego; ?>" selected hidden><?php echo $genjuego; ?></option>
                <option value="plats">Plataformas</option>
                <option value="pelea">Pelea</option>
                <option value="accion">Acci&oacute;n</option>
                <option value="puzzles">Puzzles</option>
            </select>
            <br>
            <label class="bloquenomlargo" for="anno"><b>A&ntilde;o de<br>lanzamiento</b></label>
            <input type="number" name="anno" value="<?php echo $anojuego; ?>" placeholder="Ej: 1985">
            <br>
            <label class="bloquenomlargo" for="link"><b>Link de<br>descarga</b></label>
            <input type="text" name="link" value="<?php echo $linkjuego; ?>" placeholder="Ej: google.com">
            <br>
            <br>
            <input type="hidden" name="nombreantiguo" value="<?php echo $nom; ?>">
            <input class="botongeneral" type="submit" name="enviar" value="Aplicar cambios" onclick="comprobardatosjuego()">
        </form>
        <?php mysqli_close($conn); ?>
    </div>
</body>
</html>

