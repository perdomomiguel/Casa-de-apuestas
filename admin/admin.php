<?php
// Se crea la conexión con la base de datos en el archivo "config.php"
include "../partes/config.php";
include "../partes/functions.php";

// Se mantiene la sesión iniciada del usuario que inició como administrador
session_start();

// Se mantienen los datos de la sesión del usuario que se vaya a usar
$dni = $_SESSION["dni"];
$email = $_SESSION["email"];
$nombre = $_SESSION["nombre"];


// Botón que nos manda al archivo "mostrar_clientes.php" que muestra la tabla de clientes existentes en la tabla de usuarios
if (isset($_POST["mostrar_clientes"])) {
    header("Location:mostrar_clientes.php");
}

// Botón que nos envía al archivo "logout.php" que nos cierra la sesión de usuario
if(isset($_POST["cerrar_sesion"])) {
    header("Location:../form/logout.php");
}

// Botón que nos redirige al archivo "anadir_admin.php" que permitirá al admin que inició sesión registrar nuevos administradores
if (isset($_POST["anadir_admin"])) {
    header("location:anadir_admin.php");
}

// Botón que nos envía al archivo "mostrar_admin.php" que muestra la tabla de administradores existentes en la tabla de usuarios
if (isset($_POST["mostrar_admin"])) {
    header("location:mostrar_admin.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "Bienvenido admin $nombre" ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<nav>
<div class="div_admin">
            <img class="profile" src="../img/profile.png" alt="">
            <?php echo "<h1 class='nombre'>$nombre</h1>"?>
</div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1 class="h1_admin">Administrador</h1>
        <hr>
            <form class="form_admin" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="botones_admin">
                <button class="boton" type="submit" name="mostrar_clientes">Mostrar Clientes</button>
                <button class="boton" type="submit" name="mostrar_admin">Mostrar Administradores</button>
                <button class="boton" type="submit" name="anadir_admin">Añadir Administrador</button>
            </div>
                
                <button type="submit" class="cerrar_sesion" name="cerrar_sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>
</div>

<footer>Copyright © 2023 Mike Inc.</footer>
