<?php

header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';");


session_start();

$username = 'juegosacceso';
$password = 'admin';
$host = 'db';
$db = 'juegos';

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$lista = mysqli_query($conn, "SELECT * FROM juegosAnadidos");

if ($lista) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 

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
    <!-- <link rel="icon" type="image/x-icon" href="skullspining.png"> -->
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
    <h2>Juegos</h2>

    <div class="cajatextogrande">
        <br>
        <a class="enlacecentral" href="anadirjuego.php">A&ntilde;adir juego</a>
        <br>
        <p>Aqu&iacute; se mostrar&aacute;n los juegos presentes en la base de datos.</p>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Puntuaci&oacute;n</th>
                    <th>G&eacute;nero</th>
                    <th>A&ntilde;o</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($fila = mysqli_fetch_assoc($lista)) {
                    echo "
                    <tr>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Puntuacion']}</td>
                        <td>{$fila['Genero']}</td>
                        <td>{$fila['Ano']}</td>
                        <td>
                            <form action='editarjuego.php' method='post'>
                                <input type='hidden' name='csrf_token' value='" . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) . "'>
                                <input type='hidden' name='Nombre' value='" . htmlspecialchars($fila['Nombre'], ENT_QUOTES) . "'>
                                <input type='submit' class='botonreduc' value='Editar'>
                            </form>
                        </td>
                        <td>
                            <form action='borrarjuego.php' method='post'>
                                <input type='hidden' name='csrf_token' value='" . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) . "'>
                                <input type='hidden' name='Nombre' value='" . htmlspecialchars($fila['Nombre'], ENT_QUOTES) . "'>
                                <input type='submit' class='botonreduc' value='Borrar'>
                            </form>
                        </td>
                    </tr>";
                }
            ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
    </div>
</body>
</html>

<?php
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

