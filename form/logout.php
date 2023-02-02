<?php
// Finaliza la sesión del usuario que cerró sesión y vuelve al "login.php"
session_start();
session_destroy();
session_unset();
header("Location:login.php");
exit();
?>