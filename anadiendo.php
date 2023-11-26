<?php
header('X-Frame-Options: DENY');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Juegos Legales</title>
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="icon" type="image/x-icon" href="skullspining.png"> -->
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
    $host = "db";
    $usuario = "juegosacceso";
    $contrasena = "admin";
    $maria = "juegos";
    $dbconnect = mysqli_connect($host, $usuario, $contrasena, $maria);

    if (!$dbconnect) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    if (isset($_POST['confirmar'])) {
        // Validar y limpiar la entrada de usuario
        $nombre = strip_tags(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
        $desarrollador = strip_tags(htmlspecialchars($_POST['desa'], ENT_QUOTES, 'UTF-8'));
        $puntuacion = (float) $_POST['puntu']; // Asegurarse de que sea un número
        $genero = strip_tags(htmlspecialchars($_POST['gen'], ENT_QUOTES, 'UTF-8'));
        $ano = (int) $_POST['anno']; // Asegurarse de que sea un número entero
        $link = htmlspecialchars($_POST['link']);

        // Verificar que el nombre del archivo esté dentro de un directorio específico
        $ruta_archivo = 'directorio_de_archivos/' . basename($link);

        // Comprobar si la ruta del archivo es válida
        if (file_exists($ruta_archivo)) {
            // Tu lógica para añadir el juego aquí
            // No insertar la ruta del archivo en la base de datos, solo el nombre del archivo
            // Ejemplo: INSERT INTO juegosAnadidos (Nombre, Desarrollador, Puntuacion, Genero, Ano, Link) VALUES (?,?,?,?,?,?)
            echo "<h2>Juego añadido</h2>
                <div class='cajaborrado'>
                    <br>
                    <p>Juego añadido correctamente.</p>
                    <br>
                    <a href='juegos.php' class='enlacecentral'>Volver a Juegos</a>
                </div>";
        } else {
            echo "<h2>Juego no añadido</h2>
                <div class='cajaborrado'>
                    <br>
                    <p>Error al añadir el juego: Ruta de archivo inválida.</p>
                    <br>
                    <a href='juegos.php' class='enlacecentral'>Volver a Juegos</a>
                </div>";
        }
    } else {
        echo "<h2>Error</h2>
            <div class='cajaborrado'>
                <br>
                <p>Algo salió mal.</p>
                <br>
                <a href='juegos.php' class='enlacecentral'>Volver a Juegos</a>
            </div>";
    }

    mysqli_close($dbconnect);
    ?>

</body>
</html>

