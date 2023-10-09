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

<br>
<div class="cajatextogrande">
    <br>
    <a class="enlacecentral" href="anadirjuego.html">A&ntilde;adir juego</a>
    <br>
    <p>Aqu&iacute; se mostrar&aacute;n los juegos presentes en la base de datos.</p>

    <?php
        $username='juegosacceso';
        $password='admin';
        $host='localhost';
        $db = 'juegos';
        $conn = mysqli_connect($host,$username,$password,$db) or die("No se pudo conectar con la base de datos.");
        //$db = mysqli_select_db(,$conn) or die("No se pudo conectar con la base de datos.");
        $lista = mysqli_query($conn, "SELECT * FROM juegosAnadidos"); ?>
   

        
       

          <table>
                <thread>
                    <tr>
                        <th>Nombre</th>
                        <th>Puntuaci&oacute;n</th>
                        <th>G&eacute;nero</th>
                        <th>A&ntilde;o</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thread>
                <tbody>
        <?php
            while($fila = mysqli_fetch_assoc($lista)){
                echo
                "
                    <tr>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Puntuacion']}</td>
                        <td>{$fila['Genero']}</td>
                        <td>{$fila['Ano']}</td>
                        <td>
                            <form action='editarjuego.php' method='post'>
                                <input type='hidden' name='Nombre' value={$fila['Nombre']}>
                                <input type='submit' class='botonreduc' value='Editar'>
                            </form>
                        </td>
                        <td>
                          <form action='borrarjuego.php' method='post'>
                                <input type='hidden' name='Nombre' value={$fila['Nombre']}>
                                <input type='submit' class='botonreduc' value='Borrar'>
                            </form>
                          
                        </td>
                    <tr>
           
        
       
        ";} mysqli_close($conn); ?>   </tbody>
        </table>
</div>
</body>
</html>
