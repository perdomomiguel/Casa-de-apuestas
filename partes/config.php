<?php

$db = mysqli_conect(
    $_ENV["DB_HOST"],
    $_ENV["DB_USER"],
    $_ENV["DB_PASS"],
    $_ENV["DB_DB"]
);

public function comprobarRutas() {
    $currentUrl = $_SERVER["REQUEST_URI"] ==="" ? "/" : $_SERVER["REQUEST_URI"];
    $method = $_SERVER["REQUEST_METHOD"];
}

require __DIR__ . '/../vendor/autoload.php';
$dotenv-Dotenv\Dotenv:: createImmutable(__DIR__);
$dotenv->safeLoad();
?>