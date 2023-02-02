<?php
// Se crea la conexión con la base de datos en el archivo "config.php" 
include "../partes/config.php";

// Se va a utiliza el archivo "functions.php"
include "../partes/functions.php";

// Se mantiene la sesión iniciada del cliente
session_start();

// Se recogen los datos de sesión del usuario
$dni = $_SESSION["dni"];
$email = $_SESSION["email"];
$nombre = $_SESSION["nombre"];

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
    <title>Máximo goleador</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="title">Máximo goleador de cada liga</h1>
    <form action="" method="post">
    <div class="partidos">
    <?php
        // Al realizar la apuesta se comprueba si todos los campos no están vacíos
        if (isset($_POST["submit_goleador"]) && $_POST["cantidad1"] != "" && $_POST["cantidad2"] != "" && $_POST["cantidad3"] != "") {
            $tipo = "Máximo goelador";
            $fecha = date('d/m/Y');
            $apuesta = "Liga Santander: " . $_POST["goleador1"] . "<br><br>Premier League: " . $_POST["goleador2"] . "<br><br>Ligue 1: " . $_POST["goleador3"];
            $cantidad = $_POST["cantidad1"] + $_POST["cantidad2"] + $_POST["cantidad3"];

            goleador($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo);

        } if (isset($_POST["submit_goleador"])) {
           if($_POST["cantidad1"] == "" || $_POST["cantidad2"] == "" || $_POST["cantidad3"] == "") {
            echo "<p class='error'>Asegúrese de rellenar todos los campos</p>";
            } 
        }
        ?>
        <h2>Liga Santander</h2>

        <ul>

            <select name="goleador1" id="" class="select_goleador">
                <option value="Lewandoski">Lewandoski (Barcelona)</option>
                <option value="Joselu">Joselu (Espanyol)</option>
                <option value="Benzema">Benzema (Real Madrid)</option>
            </select>
        
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad1" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>
        <hr>
        <h2>Premier League</h2>
  
        <ul>
            <select name="goleador2" id="" class="select_goleador">
                <option value="Haaland">Erling Haaland (M. City)</option>
                <option value="Kane">Harry Kane (Tottenham)</option>
                <option value="Toney">Ivan Toney (Brentford)</option>
            </select>
        
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad2" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>
        <hr>
        <h2>Ligue 1</h2>
 
        <ul>
            <select name="goleador3" id="" class="select_goleador">
                <option value="Messi">Lionel Messi (PSG)</option>
                <option value="Mbappé">Mbappé (PSG)</option>
                <option value="Neymar">Neymar (PSG)</option>
            </select>
        
            <div>
            <label for="apuesta">Cantidad a apostar</label>
            <input type="number" name="cantidad3" min="1" max="100" placeholder="1€ - 100€">
            </div>
            
        </ul>

        <div class="botones">
        <input class="submit" type="submit" name="submit_goleador" value="Finalizar">
        <input class="volver" type="submit" name="regresar" value="Volver al inicio">
        </div>
        
    </form>
    </div>
    
</body>
<footer>Copyright © 2023 Mike Inc.</footer>
</html>