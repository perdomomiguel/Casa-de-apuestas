<?php
// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se inicia la sesión del usuario que vaya a iniciarla
session_start();

if (isset($_POST["login"])) {
    require_once "../partes/functions.php";

    // Consulta que verifica que el usuario los datos del usuario son correctos
    $sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '" . $_POST["email"] . "' and contrasena = '" . $_POST["contrasena"] . "'");
    $fila = mysqli_fetch_array($sql);
}

// Manda al usuario a la sección de registrar
if (isset($_POST["registrar"])) {
    header("Location:../form/registrar.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<h1 class="title">Casa de Apuestas</h1>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1 class="h1_login">Inicio de sesión</h1>
        <div class="error">
            
        </div>
        <?php
        // Comprueba si el usuario es cliente o administrador
        if(isset($_POST["login"])) {
            // Verifica si existe una fila con los datos insertados en el form
            if (mysqli_num_rows($sql) == 1) {
                if ($fila["tipo"] == "cliente") {

                    // Recoge los datos del cliente de la sesión
                    $_SESSION["email"] = $fila["email"];
                    $_SESSION["dni"] = $fila["dni"];
                    $_SESSION["nombre"] = $fila["nombre"];
                    header("Location:../cliente/cliente.php");
                } 
                
                if ($fila["tipo"] == "admin" && mysqli_num_rows($sql) == 1) {
                    // Recoge los datos del admin de la sesión
                    $_SESSION["email"] = $fila["email"];
                    $_SESSION["dni"] = $fila["dni"];
                    $_SESSION["nombre"] = $fila["nombre"];
                    header("Location:../admin/admin.php");
                }  
            } else {
                // Devuelve error si los datos introducidos son incorrectos
                echo "<p class='error'>Correo electrónico o contraseña incorrectos</p>";
            }
        }
        
        ?>
        <hr>
            <form method="post" action="#">
                <div class="datos">
                    <label class="datos2" for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" placeholder="Introduce tu correo electrónico">
                </div>

                <div class="datos">
                    <label class="datos2" for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" placeholder="Introduce la contraseña">
                </div>

                <div class="login_botones">
                    <button class="boton" type="submit" class="btn btn-link" name="registrar">Registrar una cuenta</button>
                    <button class="boton" type="submit" class="btn btn-primary" name="login">Iniciar Sesión</button>
                </div>

                
            </form>
        </div>
    </div>
</div>
<footer>Copyright © 2023 Mike Inc.</footer>
</body>
</html>


