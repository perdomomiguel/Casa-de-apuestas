<?php

// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se mantiene la sesión iniciada del cliente que realizó el login
session_start();

$dni = $_SESSION["dni"];
$email = $_SESSION["email"];
$nombre = $_SESSION["nombre"];

// Envía al cliente al archivo "quiniela.php"
if(isset($_POST["quiniela"])) {
    header("location:quiniela.php");
}

// Envía al cliente al archivo "goleador.php"
if(isset($_POST["goleador"])) {
    header("location:goleador.php");
}

// Envía al cliente al archivo "partido.php"
if(isset($_POST["partido"])) {
    header("location:partido.php");
}

// Envía al cliente al archivo "logout.php" que cierra la sesión 
if(isset($_POST["logout"])) {
    header("location:../form/logout.php");
}

// Envía al cliente al archivo "editar.php" 
if(isset($_POST["editar"])) {
    header("location:editar.php");
}

// Consulta que muestra las apuestas realizadas por el cliente
$sql = "SELECT * FROM apuestas WHERE dni = $dni";

// Se realiza la conexión entre la consulta y la base de datos
$resultado = $conexion->query($sql);

// Devuelve error si la consulta no es válida
if (!$resultado) {
    die ("Consulta no válida: " . $conexion->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "Bienvenido $nombre" ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="menu">
    <nav>
        <div class="div_nombre">
            <img class="profile" src="../img/profile.png" alt="">
            <?php echo "<h1 class='nombre'>$nombre</h1>"?>
        </div>
        
        <form method="post" action="" class="form_cliente">
            <input type="submit" name="quiniela" value="Quiniela">
            <input type="submit" name="goleador" value="Máximo goleador">
            <input type="submit" name="partido" value="Resultado partido">
            <input type="submit" name="editar" value="Editar perfil">
            <input class="cerrar_sesion_input" type="submit" name="logout" value="Cerrar Sesión">
        </form>
    </nav>
    
</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Apuesta</th>
                            <th>Fecha</th>
                            <th>Apuesta</th>
                            <th>Cantidad apostada</th>
                            <th>Eliminar apuesta</th>
 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Bucle que devuelve en forma de array asociativo los datos de las apuestas que ha realizado el cliente
                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<tr>
                                    <td>' .  $fila["tipo"] . '</td>
                                    <td>' . $fila["fecha"] . '</td>
                                    <td>' . $fila["apuesta"] . '</td>
                                    <td>' .  $fila["cantidad"] . '€</td>
                                    <td>
                                    <a href="eliminar_apuesta.php?id=' . $fila["id"] . '" class="eliminar" name="eliminar">Eliminar</a>
                                    </td>                      
                                </tr>'   
                        ?>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <footer>Copyright © 2023 Mike Inc.</footer>
</body>
</html>

<style src="main.css"></style>