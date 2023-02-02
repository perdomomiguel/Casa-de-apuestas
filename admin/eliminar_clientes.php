<?php
// Se crea la conexión con la base de datos en el archivo "config.php" para poder eliminar los datos
include "../partes/config.php";

// Sin la implementación de un botón, automáticamente recarga la página para comprobar que se borraron los datos
header("location:mostrar_clientes.php");

// Consulta que elimina los usuarios en donde el admin realiza click en el archivo "mostrar_clientes.php"
$consultaSQL = "DELETE FROM usuarios WHERE dni =" . $_GET["dni"];

// La sentencia prepara la consultaSQL antes de realizarse y luego la ejecuta
$sentencia = $conexion->prepare($consultaSQL);
$sentencia -> execute();
?>