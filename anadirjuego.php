<?php
header('X-Frame-Options: DENY');

session_start();

// Generar el token CSRF si no existe en la sesión
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
        <a href="modificardatos.php">Datos personales</a>
        <a href="about.php">About</a>
    </div>
    
    <h2>A&ntilde;adir juego</h2>
    
    <div class="cajaregistro">
        <form action="http://localhost:8000/anadiendo.php" name="formulario" method="POST">
            <!-- Agregar un campo oculto para el token CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

            <br>
            <label for="nombre"><b>Nombre</b></label>
            <input type="text" name="nombre" placeholder="Ej: Super Mario Bros" onkeypress="return /[0-9A-Za-z-.¿?¡!]/i.test(event.key)">
            <br>
            <label for="desa"><b>Desarrollador</b></label>
            <input type="text" name="desa" placeholder="Ej: Nintendo" onkeypress="return /[0-9A-Za-z-'¿?¡!]/i.test(event.key)">
            <br>
            <label for="puntu"><b>Puntuaci&oacute;n</b></label>
            <input type="number" name="puntu" max=10 placeholder="Ej: 9.5" onkeypress="return /[0-9.]/i.test(event.key)">
            <br>
            <label for="gen"><b>G&eacute;nero</b></label>
            <select name="gen" id="gen">
                <option value="plats">Plataformas</option>
                <option value="pelea">Pelea</option>
                <option value="accion">Acci&oacute;n</option>
                <option value="puzzles">Puzzles</option>
            </select>
            <br>
            <label class="bloquenomlargo" for="anno"><b>A&ntilde;o de<br>lanzamiento</b></label>
            <input type="number" name="anno" placeholder="Ej: 1985" onkeypress="return /[0-9]/i.test(event.key)">
            <br>
            <label class="bloquenomlargo" for="link"><b>Link de<br>descarga</b></label>
            <input type="text" name="link" placeholder="Ej: google.com" onkeypress="return /[0-9A-Z-.?¿/$%#~@]/i.test(event.key)">
            <input type="hidden" name="confirmar" value="confirmar">
            <input type="button" class="botongeneral" name="enviar" value="Enviar" onclick="comprobardatosjuego()">
        </form>
    </div>
</body>
</html>
