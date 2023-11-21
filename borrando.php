<?php
header('X-Frame-Options: DENV');
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
    /*echo $_POST['nom'];*/
    $nom = $_POST['nom'];
    //echo $nom;
    $nom = substr($nom, 1);
    $username='juegosacceso';
    $password='admin';
    $host='db';
    $db = 'juegos';
    $conn = mysqli_connect($host,$username,$password,$db)  or die("No se pudo conectar con la base de datos.");
    $query = "DELETE FROM juegosAnadidos WHERE Nombre='".$nom."'";
    $resultado = mysqli_query($conn, $query);/*/devueve booleano*/
    
    
    
    if($resultado){
    	echo "<h2>Juego borrado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Juego eliminado correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
    }else{
    	echo "<h2>Juego no borrado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>No se ha podido eliminar el juego.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
    }

mysqli_close($conn);
?>


        
</body>

</html>
