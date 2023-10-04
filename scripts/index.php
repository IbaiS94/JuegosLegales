<?php
$host = "localhost";
$usuario = "juegosacceso";
$contrasena = "admin";
$maria = "juegos";
$dbconnect=mysqli_connect($host,$usuario,$contrasena,$maria);
if($dbconnect->connect_error){
	die("error de conexion");
}
if(isset($_POST['enviar'])) {
  $nombre=$_POST['nombre'];
  $desarrollador=$_POST['desa'];
  $puntuacion=$_POST['puntu'];
  $genero=$_POST['gen'];
  $ano=$_POST['anno'];
  $link=$_POST['link'];
$q = "INSERT INTO juegosAnadidos (Nombre, Desarrollador, Puntuacion, Genero, Ano, Link) VALUES ('$nombre', '$desarrollador', '$puntuacion','$genero','$ano','$link')";
      if (mysqli_query($dbconnect, $q)) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . mysqli_error($dbconnect);
}
}
?>
