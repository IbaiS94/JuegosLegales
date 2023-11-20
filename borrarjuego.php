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
    <a href="login.html">Log in</a>
    <a href="signin.html">Sign in</a>
    <a href="about.html">About</a>
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
            <input class="botongeneral" type="submit" name="borrar" value="Borrar">
        </form>
        </div>
</body>

</html>

