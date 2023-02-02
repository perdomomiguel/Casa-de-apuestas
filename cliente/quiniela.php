<?php
// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se incluye el archivo "functions.php" porque se va a usar
include "../partes/functions.php";

// Se mantiene la sesión iniciada del cliente
session_start();

// Se recogen los datos de sesión del usuario
$dni = $_SESSION["dni"];
$email = $_SESSION["email"];
$nombre = $_SESSION["nombre"];

// Array de equipos de fútbol
$equipos1 = ["Barcelona", "Real Madrid", "Las Palmas", "Bayern de Múnich", "Real Betis", "Sevilla", "Manchester City", "Liverpool", "Chelsea", "Tenerife"];
$equipos2 = ["Al Nassr", "Paris Saint Germain", "Albacete", "Atlético de Madrid", "Manchester United", "Newcastle", "Villarreal", "Real Sociedad", "Juventus", "Boca Juniors"];

// Randomizador de equipos de fútbol
$random1 = array_rand($equipos1, 10);
$random2 = array_rand($equipos2, 10);

// Regresa al menú principal del cliente
if (isset($_POST["regresar"])) {
    header("location:cliente.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiniela</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="title">Enfrentamientos</h1>
    <form action="" method="post">
    <div class="partidos">
    <?php
        // Al realizar la apuesta se comprueba si todos los campos no están vacíos
        if (isset($_POST["submit_quiniela"]) && $_POST["cantidad1"] != "" && $_POST["cantidad2"] != "" && $_POST["cantidad3"] != "") {
            $tipo = "Quiniela";
            $fecha = date('d/m/Y');
            $apuesta = $equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random1[rand(0,9)]] . ": " . $_POST["quiniela1"] . "<br><br>" . $equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random2[rand(0,9)]] . ": " . $_POST["quiniela2"] . "<br><br>" .  $equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random2[rand(0,9)]] . ": " . $_POST["quiniela3"];
            $cantidad = $_POST["cantidad1"] + $_POST["cantidad2"] + $_POST["cantidad3"];

            quiniela($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo);

        } if (isset($_POST["submit_quiniela"])) {
            if($_POST["cantidad1"] == "" || $_POST["cantidad2"] == "" || $_POST["cantidad3"] == "") {
            // Devuelve mensaje de error si los campos está vacíos
            echo "<p class='error'>Asegúrese de rellenar todos los campos</p>";
            } 
         }
    ?>
        
        <ul>
            <div class='encuentro'><?=$equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random2[rand(0,9)]] ?></div>

            <select name="quiniela1" id="">
                <option value="1">1</option>
                <option value="x">X</option>
                <option value="2">2</option>
            </select>
            
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad1" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
            
        </ul>

        <hr>
        <ul>
            <?php
                echo "<div class='encuentro'>" . $equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random2[rand(0,9)]] . "</div>";
            ?>

            <select name="quiniela2" id="">
                <option value="1">1</option>
                <option value="x">X</option>
                <option value="2">2</option>
            </select>
            
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad2" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>
        <hr>
        <ul>
            <?php
                echo "<div class='encuentro'>" . $equipos1[$random1[rand(0,9)]] . " VS " . $equipos2[$random2[rand(0,9)]] . "</div>";
            ?>

            <select name="quiniela3" id="">
                <option value="1">1</option>
                <option value="x">X</option>
                <option value="2">2</option>
            </select>
            
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad3" min="1" max="100" placeholder="1€ - 100€">
            </div>
    
        </ul>

        <div class="botones">
        <input type="submit" name="submit_quiniela" value="Finalizar">
        <input type="submit" name="regresar" value="Volver al inicio">
    </div>
    </div>
        
    </form>
</body>
<footer>Copyright © 2023 Mike Inc.</footer>
</html>