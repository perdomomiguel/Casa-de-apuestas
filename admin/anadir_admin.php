<?php
// Se crea la conexión con la base de datos en el archivo "config.php"

include "../partes/config.php";

// Mantiene la sesión iniciada del administrador
session_start();

// Regresa al menú principal "admin.php"  que inició la sesión
if (isset($_POST["regreso"])) {
    header("location:admin.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="title">Añadir Administrador</h1>
    <div class="registrar">
        <?php
if (isset($_POST["registro"])) {
    // Se inicia un contador para comprobar que los datos introducidos son correctos
    $contador = 0;

    // Recoge los datos del formulario
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $edad = $_POST["edad"];
    $telefono = $_POST["telefono"];
    $tipo = "admin";

    // Incluye una vez el archivo "functions.php" que realizará las siguientes funciones
    require_once "../partes/functions.php";

    // Funciones del archivo "functions.php" que comprueban que los datos introducidos son válidos
    if (registro_vacio($dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono) !== false) {
        echo "<p class='error'>Asegúrese de rellenar todos los campos</p>";
        $contador++;
    }

    if (error_nombre($nombre) !== false) {
        echo "<p class='error'>Nombre escrito en formato no válido</p>";
        $contador++;
    }

    if (error_apellidos($apellidos) !== false) {
        echo "<p class='error'>Apellidos escritos en formato no válido</p>";
        $contador++;
    }

    if (error_telefono($telefono) !== false) {
        echo "<p class='error'>Número de teléfono escrito en formato incorrecto</p>";
        $contador++;
    }

    if (usuario_existe($conexion, $nombre, $correo) !== false) {
        echo "<p class='error'>El usuario ya existe</p>";
        $contador++;
    }

    // Si no hay errores, el usuario se registra por el admin
    if ($contador == 0 ) {
        registrarAdmin($conexion, $dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono, $tipo);
    }
}
        ?>
        <h1 class="h1_registrar">Registrar nuevo administrador</h1>
        <hr>

        <form class="form_registrar"  action="" method="post">
                    <div class="col">
                    <div class="form-group">
                        <label class="datos2" for="dni">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" maxlength="9" placeholder="Número de identificación">
                    </div> 

                    <div class="form-group">
                        <label class="datos2" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="30" placeholder="Inserte su nombre">
                    </div>

                    <div class="form-group">
                        <label class="datos2" for="apellidos">Apellidos</label>
                        <input type="apellidos" name="apellidos" id="apellidos" class="form-control" maxlength="30" placeholder="Inserte sus apellidos">
                    </div>

                    <div class="form-group">
                        <label class="datos2" for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" maxlength="50" placeholder="Inserte se correo electrónico">
                    </div>
                    </div>
                    
                    <div class="col">
                    <div class="form-group">
                        <label class="datos2" for="contrasena">Contraseña</label>
                        <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Inserte su contraseña" maxlength="50">
                    </div>  

                    <div class="form-group">
                        <label class="datos2" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Inserte su número de teléfono" maxlength="9">
                    </div>

                    <div class="form-group">
                        <label class="datos2" for="edad">Edad</label>
                        <input type="number" name="edad" id="edad" class="form-control" max="100" placeholder="Inserte su Edad">
                    </div>
                    </div>
                    
                             

                    <div class="form-group-2">
                       <input  type="submit" name="registro" class="boton" value="Enviar">
                       <input type="submit" name="regreso" class="boton" value="Volver al login">
                    </div>
                </form>
    </div>
    <footer>Copyright © 2023 Mike Inc.</footer>
</body>
</html>
