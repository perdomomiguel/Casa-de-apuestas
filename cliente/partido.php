<?php
// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se incluye el archivo "functions.php" porque se va a usar
include "../partes/functions.php";

//Se mantiene la sesión iniciada del cliente
session_start();

// Se recogen los datos de sesión del usuario
$dni = $_SESSION["dni"];
$email = $_SESSION["email"];
$nombre = $_SESSION["nombre"];

// Array de equipos de fútbol
$santander = ["Barcelona", "Real Madrid", "Las Palmas", "Real Betis", "Sevilla","Tenerife", "Villarreal", "Albacete", "Atlético de Madrid", "Osasuna"];
$premier = ["Manchester City", "Manchester United", "Leeds United", "Chelsea", "Aresenal", "Aston Villa", "Newcastle", "Watford", "Wolves", "Liverpool"];
$ligue1 = ["Paris Saint Germain", "Lyon", "Reims", "Clermont", "Nantes", "Angers", "Auxerre", "Ajaccio", "Toulouse", "Stade Brestois"];

// Randomizador de equipos de fútbol
$random1 = array_rand($santander, 10);
$random2 = array_rand($premier, 10);
$random3 = array_rand($ligue1, 10);

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
    <title>Resultado partidos</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="title">Enfentamientos</h1>
    <form action="" method="post">
    <div class="partidos">
        
        <?php
        // Al realizar la apuesta se comprueba si todos los campos no están vacíos
        if (isset($_POST["submit_partido"]) && $_POST["cantidad1"] != "" && $_POST["cantidad2"] != "" && $_POST["cantidad3"] != "") {
            $tipo = "Resultado partido";
            $fecha = date('d/m/Y');
            $apuesta = $santander[$random1[rand(0,9)]] . " VS " . $santander[$random1[rand(0,9)]] . ": " . $_POST["partido1"] . "<br><br>" . $premier[$random2[rand(0,9)]] . " VS " . $premier[$random2[rand(0,9)]] . ": " . $_POST["partido2"] . "<br><br>" .  $ligue1[$random3[rand(0,9)]] . " VS " . $ligue1[$random3[rand(0,9)]] . ": " . $_POST["partido3"];
            $cantidad = $_POST["cantidad1"] + $_POST["cantidad2"] + $_POST["cantidad3"];

            partido($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo);
            
        } if (isset($_POST["submit_partido"])) {     
            if($_POST["cantidad1"] == "" || $_POST["cantidad2"] == "" || $_POST["cantidad3"] == "") {
            // Devuelve mensaje de error si los campos está vacíos
            echo "<p class='error'>Asegúrese de rellenar todos los campos</p>";
            } 
         }
        ?>

        <h2>Liga Santander</h2>
        <ul>
            
            <?php
                // Muestra el encuentro entre dos equipos seleccionados al azar 
                echo "<div class='encuentro'>" . $santander[$random1[rand(0,9)]] . " VS " . $santander[$random1[rand(0,9)]] . "</div>";
            ?>

            <select name="partido1" id="">
                <option value="0 - 0">0 - 0</option>
                <option value="1 - 0">1 - 0</option>
                <option value="0 - 1">0 - 1</option>
            </select>
        
            <div>
                <label for="apuesta">Cantidad a apostar</label>
                <input type="number" name="cantidad1" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>
        <hr>
        <h2>Premier League</h2>

        <ul>
            
            <?php
                echo "<div class='encuentro'>" . $premier[$random2[rand(0,9)]] . " VS " . $premier[$random2[rand(0,9)]] . "</div>";
            ?>

            <select name="partido2" id="">
                <option value="0 - 0">0 - 0</option>
                <option value="1 - 0">1 - 0</option>
                <option value="0 - 1">0 - 1</option>
            </select>
        
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad2" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>
        <hr>
        <h2>Ligue 1</h2>
       
        <ul>
            
            <?php
                echo "<div class='encuentro'>" . $ligue1[$random3[rand(0,9)]] . " VS " . $ligue1[$random3[rand(0,9)]] . "</div>";
            ?>

            <select name="partido3" id="">
                <option value="0 - 0">0 - 0</option>
                <option value="1 - 0">1 - 0</option>
                <option value="0 - 1">0 - 1</option>
            </select>
        
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad3" min="1" max="100" placeholder="1€ - 100€">
            </div>
        </ul>

        <div class="botones">
        <input type="submit" name="submit_partido" value="Finalizar">
        <input type="submit" name="regresar" value="Volver al inicio">
        </div>
    </diV>
        
    </form>
</body>
<footer>Copyright © 2023 Mike Inc.</footer>
</html>