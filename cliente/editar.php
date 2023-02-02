<?php

// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se mantiene la sesión iniciada del cliente
session_start();

// Se crean variables que recogen los datos de la sesión del usuario que se vayan a usar 
$dni = $_SESSION["dni"];
$nombre = $_SESSION["nombre"];

// Regresa al menú principal del cliente
if (isset($_POST["regreso"])) {
    header("location:cliente.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="login">
<h1 class="title">Editar perfil de <?= $nombre ?></h1>
    <div class="editar">
        <h1 class="h1_registrar">Editar cuenta existente</h1>
        <?php
        if (isset($_POST["editar"])) {
            // Se recogen los datos del formulario con el método "$_POST"
            $nuevo_nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];
            $tipo = "cliente";

            // Se realiza una consulta que reemplace los datos del cliente de la tabla de usuarios por los introducidos en el formulario
            $sql = "UPDATE usuarios SET nombre = '". $nuevo_nombre . "', apellidos = '" . $apellidos . "', correo = '" . $correo . "', telefono = '" . $telefono . "', tipo = '" . $tipo . "'WHERE dni ='" . $dni . "'";

            // Si la consulta no da errores y no hay datos vacíos, regresa al menú principal del cliente
            if ($conexion->query($sql) === TRUE && $_POST["nombre"] != "" && $_POST["apellidos"] != "" && $_POST["correo"] != "" && $_POST["telefono"] != "") {
                header("location:cliente.php");
              } else {
                  // Devuelve mensaje de error si hay campos vacíos
                echo "<p class='error'>Asegúrese de rellenar todos os campos</p>";
              }

            // Se cambian los datos de sesión del usuario por los nuevos insertados
            $_SESSION["nombre"] = $nuevo_nombre;
            $_SESSION["apellidos"] = $apellidos;
            $_SESSION["correo"] = $correo;
            $_SESSION["telefono"] = $telefono;   
        }
        ?>
        <hr>
        
                <form class="form_editar" action="" method="post">
                    <div class="col">
                    <div class="form-group">
                        <label class="datos2" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="30" placeholder="Inserte su nombre">
                    </div>

                    <div class="form-group">
                        <label class="datos2" for="apellidos">Apellidos</label>
                        <input type="apellidos" name="apellidos" id="apellidos" class="form-control" maxlength="30" placeholder="Inserte sus apellidos">
                    </div>
                    </div>
                    
                    <div class="col">
                    <div class="form-group">
                        <label class="datos2" for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" maxlength="50" placeholder="Inserte se correo electrónico">
                    </div>
                    <div class="form-group">
                        <label class="datos2" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Inserte su número de teléfono" maxlength="9">
                    </div>
                    </div>                                                 

                    <div class="form-group-2">
                       <input  type="submit" name="editar" class="boton" value="Enviar">
                       <input type="submit" name="regreso" class="boton" value="Volver al login">
                    </div>
                </form>
    </div>
    <footer>Copyright © 2023 Mike Inc.</footer>
</body>
</html>