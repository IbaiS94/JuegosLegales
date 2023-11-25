<?php
header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';");

?>
<!DOCTYPE html>
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
    <a href="login.php">Log in</a>
    <a href="signin.php">Sign in</a>
    <a href="modificardatos.php">Datos personales</a>
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
	echo "<h2>Usuario no actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>No se han podido actualizar tus datos.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}
$galletita = $_COOKIE["IdentComo"];
//$q7 = "SELECT * FROM usuarios WHERE galletita='" . $galletita . "'";
//$result = mysqli_fetch_assoc(mysqli_query($dbconnect, $q7));
//datos de bd
$q7 = "SELECT * FROM usuarios WHERE galletita=?";
$stmt = $dbconnect->prepare($q7);
$stmt->bind_param("s",$galletita);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombd,$apebd,$pwbd,$dnibd,$telbd,$fechanacbd,$emailbd,$cookiebd);
$stmt->fetch();
//datos introducidos
$user=$_POST['nombre'];
$apellido=$_POST['apellido'];
$dni=$_POST['dni'];
$tel=$_POST['telefono'];
$fechan=$_POST['fechanac'];
$email=$_POST['email'];
$pwold=$_POST['pass'];
$pnew=$_POST['pass2'];
$pnewhash=password_hash($pwnew,PASSWORD_BCRYPT);
//if(password_verify($pwold,$result["PW"])){
if(password_verify($pwold,$pwbd)){
//$qupdate = "UPDATE usuarios SET Nombre='".$user."', Apellido='".$apellido."', DNI='".$dni."', Telefono='".$tel."', Fechanac='".$fechan."', email='".$email."', PW='".$pnewhash."' WHERE galletita='".$galletita."'";
echo "<h2>Usuario actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>Se han actualizado tus datos correctamente.</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
//mysqli_query($dbconnect, $qupdate);
$qupdate = "UPDATE usuarios SET Nombre=?, Apellido=?, DNI=?, Telefono=?, Fechanac=?, email=?, PW=? WHERE galletita=?";
$stmt = null;
$stmt = $dbconnect->prepare($qupdate);
$stmt->bind_param("sssissss",$user,$apellido,$dni,$tel,$fechan,$email,$pnewhash,$galletita);
$stmt->execute();
}
else{
echo "<h2>Usuario no actualizado</h2>
    	<div class='cajaborrado'>
    		<br>
    		<p>La contraseña introducida es incorrecta</p>
    		<br>
    		<a href=juegos.php class='enlacecentral'>Volver a Juegos</a>
    	</div>";
}
mysqli_close($dbconnect);
$stmt->close();
?>

</body>
</html>
