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
    <a href="index.html">Home</a>
    <a href="juegos.php">Juegos</a>
    <a href="login.html">Log in</a>
    <a href="signin.html">Sign in</a>
    <a href="about.html">About</a>
</div>

<?php
    /*echo $_POST['nom'];*/
    $nomviejo = $_POST['nombreantiguo'];
    $nom = $_POST['nombre'];
    $link = $_POST['link'];
    $desa = $_POST['desa'];
    $puntu = $_POST['puntu'];
    $gen = $_POST['gen'];
    $ano = $_POST['anno'];
    $username='juegosacceso';
    $password='admin';
    $host='db';
    $db = 'juegos';
    $conn = mysqli_connect($host,$username,$password,$db) or die("No se ha podido conectar con la base de datos.");
    $query = "UPDATE juegosAnadidos SET Nombre='".$nom."', Desarrollador='".$desa."', Puntuacion='".$puntu."', Genero='".$gen."', Ano='".$ano."', Link='".$link."' WHERE Nombre='".$nomviejo."'";
    $resultado = mysqli_query($conn, $query);/*/devueve booleano*/
    
    
    
    if($resultado){
    	echo "<h2>Juego editado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Juego editado correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
    }else{
    	echo "<h2>Juego no editado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>No se ha podido editar el juego.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
    }
mysqli_close($conn);
?>


        
</body>

</html>
