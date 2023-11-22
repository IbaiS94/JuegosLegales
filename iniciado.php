<?php
header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';");
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect = mysqli_connect($host, $usuario, $contrasena, $maria);

$correcto = 1; // Valor de 'Correcto'
$ip1 = $_SERVER['REMOTE_ADDR'];
$ip2 = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'No Proxy';

if ($dbconnect->connect_error){
    die("error de conexion");
    echo "<h2>Usuario no identificado</h2>
        <div class='cajaborrado'>
            <br>
            <p>Ha habido un problema con la identificación.</p>
            <br>
            <a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
        </div>";
} else {
    $DNI=$_POST['DNI'];
    $pwnohash=$_POST['pw'];

    $q = "Select * from usuarios WHERE DNI='".$DNI."' ";//AND PW='".$pw."'" ;
    $dame = mysqli_fetch_assoc(mysqli_query($dbconnect, $q));
    $resultado=mysqli_query($dbconnect, $q);

    if ((mysqli_num_rows($resultado)==1)and(password_verify($pwnohash,$dame['PW']))) {

	$q2 = "INSERT INTO logins (Correcto, DNI, `IP1`, IP2) VALUES (1, '$DNI', '$ip1', '$ip2')";
        mysqli_query($dbconnect, $q2);
        $id = base64_encode(random_bytes(40));
	$q3 = "UPDATE usuarios SET galletita = '".$id."' WHERE DNI = '".$DNI."'";
        mysqli_query($dbconnect, $q3);
        setcookie("IdentComo",$id,time()+3000, '/');

        echo ' <!DOCTYPE html>
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
                    <a href="login.html">Log in</a>
                    <a href="signin.html">Sign in</a>
                    <a href="modificardatos.php">Datos personales</a>
                    <a href="about.html">About</a>
                </div>

                <h2>Usuario identificado</h2>
                    <div class="cajaborrado">
                        <br>
                        <p>Te has identificado correctamente como '.$dame['Nombre'].'</p>
                        <br>
                        <a href=juegos.php class="enlacecentral">Volver a Juegos</a>
                    </div>
                    </body>
                </html>';
    } else {
    
	$q2 = "INSERT INTO logins (Correcto, DNI, `IP1`, IP2) VALUES (0, '$DNI', '$ip1', '$ip2')";
        mysqli_query($dbconnect, $q2);

        echo ' <!DOCTYPE html>
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
                    <a href="login.html">Log in</a>
                    <a href="signin.html">Sign in</a>
                    <a href="modificardatos.php">Datos personales</a>
                    <a href="about.html">About</a>
                </div>

                <h2>Usuario no identificado</h2>
                    <div class="cajaborrado">
                        <br>
                        <p>Contraseña y/o usuario incorrectos.</p>
                        <br>
                        <a href=juegos.php class="enlacecentral">Volver a Juegos</a>
                    </div>
                    </body>
                </html>';
    }
}

mysqli_close($dbconnect);
?>
</body>
</html>

