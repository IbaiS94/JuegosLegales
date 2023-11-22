<?php
header('X-Frame-Options: DENY');
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

<?php
$host = "db";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
}
if(isset($_POST['confirmar'])) {
  $nombre = htmlspecialchars($_POST['nombre']);
  $desarrollador = htmlspecialchars($_POST['desa']);
  $puntuacion = htmlspecialchars($_POST['puntu']);
  $genero = htmlspecialchars($_POST['gen']);
  $ano = htmlspecialchars($_POST['anno']);
  $link = htmlspecialchars($_POST['link']);
$q = "INSERT INTO juegosAnadidos (Nombre, Desarrollador, Puntuacion, Genero, Ano, Link) VALUES ('$nombre', '$desarrollador', '$puntuacion','$genero','$ano','$link')";
      if (mysqli_query($dbconnect, $q)) {
        echo "<h2>Juego a&ntilde;adido</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Juego a&ntilde;adido correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
    } else {
    	echo "<h2>Juego no a&ntilde;adido</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Error al a&ntilde;adir el juego: " . mysqli_error($dbconnect);"</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
        //echo "Error al a&ntilde;adir el juego: " . mysqli_error($dbconnect);
}
}else{
	echo "<h2>Error</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Algo fue mal.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
} 
mysqli_close($dbconnect);
?>

</body>

</html>

