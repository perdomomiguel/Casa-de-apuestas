<?php
// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Recarga la página del cliente una vez eliminada la apuesta
header("Location:cliente.php");

// Consulta que elimina la fila de la tabla de apuestas del cliente 
$consultaSQL = "DELETE FROM apuestas WHERE id =" . $_GET["id"];

// Se prepara la conexión de la consultaSQL cn la base de datos
$sentencia = $conexion->prepare($consultaSQL);

// Se ejecuta la sentencia
$sentencia -> execute();
?>