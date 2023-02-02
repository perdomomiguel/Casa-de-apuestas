<?php

// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se mantiene la sesión iniciada del administrador
session_start();

// Se realiza la consulta sql que muestre todos los administradores dentro de la tabla de usuarios
$sql = "SELECT * FROM usuarios WHERE tipo = 'admin'";

// Se realiza la conexión con la base de datos y la consulta
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
    <title><?= "Listado de clientes" ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<h2 class="title">Tabla de administradores</h2>
    <div class="container2">
        <div class="row">
            <div class="col-mt-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Bucle que devuelve los datos de los administradores en forma de array asociativo con la función "fetch_assoc"
                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<tr>
                                    <td>' .  $fila["dni"] . '</td>
                                    <td>' . $fila["nombre"] . '</td>
                                    <td>' .  $fila["apellidos"] . '</td>
                                    <td>' .  $fila["correo"] . '</td>
                                    <td>' .  $fila["edad"] . '</td>
                                    <td>' .  $fila["telefono"] . '</td>                  
                                </tr>'   
                        ?>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="admin.php" class="boton2">Volver al menú</a>
    <footer>Copyright © 2023 Mike Inc.</footer>
