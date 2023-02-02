<?php

/**
 * Esta función almacena los datos del cliente que se registra en el formulario dentro de la tabla de usuarios.
 * 
 * @param mysqli $conexion
 * @param string $dni
 * @param string $nombre
 * @param string $apellidos
 * @param string $correo
 * @param string $contrasena
 * @param int $edad
 * @param int $telefono
 * @param string $tipo
 * 
 * @return void
 */

// Función que registra al cliente 
function registrarCliente($conexion, $dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono, $tipo) {
    $sql = "INSERT INTO usuarios (dni, nombre, apellidos, correo, contrasena, edad, telefono, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $sentencia = mysqli_stmt_init($conexion);

    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        header("location: registrar.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($sentencia, "sssssiis", $dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono, $tipo);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_close($sentencia);

    header("location:login.php?error=none");
    exit();
}

/**
 * Está función comprueba que los campos de registración no quedan vacíos. Si se da el caso, devuelve true y muestra un mensaje de error por la página de 2registro.php"
 * 
 * @param string $dni
 * @param string $nombre
 * @param string $apellidos
 * @param string $correo
 * @param string $contrasena
 * @param int $edad
 * @param int $telefono
 * 
 * @return boolean
 */

// Función que devuelve error si se dejan campos vacíos de registro
function registro_vacio($dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono) {
    $resultado = false;

    if (empty($dni) ||empty($nombre) || empty($apellidos) || empty($correo) || empty($contrasena) || empty($edad) || empty($telefono)) {
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

/**
 * Esta función devuelve error si el nombre contiene caracteres númericos o que no sean letras.
 * 
 * @param string $nombre
 * 
 * @return boolean
 */

// Devuelve error si hay números u otros caracteres especiales en el campo de nombre
function error_nombre($nombre) {
    $resultado = false;

    // Se verifica si los datos del campo son adecuados con el formato indicado
    if (!preg_match("/^[a-zA-Z]*$/", $nombre)) {
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

/**
 * Esta función devuelve error si los apellidos contienen caracteres númericos o que no sean letras.
 * 
 * @param string $apellidos
 * 
 * @return boolean
 */

// Devuelve error si hay números u otros caracteres especiales en el campo de apellidos

function error_apellidos($apellidos) {
    $resultado = false;

    // Se verifica si los datos del campo son adecuados con el formato indicado
    if (!preg_match("/^[a-zA-Z]*$/", $apellidos)) {
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

/**
 * Función que devuelve error cuando se introducen valores no numéricos 
 * 
 * @param string $telefono
 * 
 * @return boolean
 */

// Comprueba si el campo de número es correcto
function error_telefono($telefono) {
    $resultado = false;

    // Si el campo no contiene números, este devuelve error
    if (!preg_match("/^[0-9]*$/", $telefono)) {
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

/**
 * Función que recoge el dni y correo electrónico del usuario. Si estos coinciden con los de uno existente, devuelve error.
 * 
 * @param mysqli $conexion
 * @param string $dni
 * @param string $gmail
 * 
 * @return boolean
 */

// Comprueba si los datos insertados ya existen en otro usuario
function usuario_existe($conexion, $dni, $gmail) {
    // Consulta que seleciona el dni o correo de la tabla de usuarios en forma oculta
    $sql = "SELECT * FROM usuarios WHERE dni = ? OR correo = ?;";

    //Se inicializa la conexión con la base de datos
    $sentencia = mysqli_stmt_init($conexion);

    // Devuelve error si la sentencia no es válida
    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        exit();
    }

    // Se pasan los datos de la función a la consulta
    mysqli_stmt_bind_param($sentencia, "ss", $dni, $gmail);

    // Se ejecuta la sentencia
    mysqli_stmt_execute($sentencia);

    // Devuelve la consulta con los datos ya insertados
    $resultado_sql = mysqli_stmt_get_result($sentencia);

    // Devuelve "false" si ocurre error a la hora de pasar los datos a la tabla de usuarios
    if ($fila = mysqli_fetch_assoc($resultado_sql)) {
        return $fila;
    } else {
        $resultado = false;
        return $resultado;
    }

    mysqli_stmt_close($sentencia);
}

/**
 * Función exactamente igual que la de registrar clientes. Solamente cambia que se registran por un administrador que ha iniciado sesión.
 * 
 * @param mysqli $conexion
 * @param string $dni
 * @param string $nombre
 * @param string $apellidos
 * @param string $correo
 * @param string $contrasena
 * @param int $edad
 * @param int $telefono
 * @param string $tipo
 * 
 * @return void
 */

// Al igual que la función de clientes, esta registra administradores. 
function registrarAdmin($conexion, $dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono, $tipo) {
    $sql = "INSERT INTO usuarios (dni, nombre, apellidos, correo, contrasena, edad, telefono, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Se inicializa la conexión con la base de datos
    $sentencia = mysqli_stmt_init($conexion);

    // Muestra error por el buscador si la sentencia no se ejecuta correctamente
    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        header("location: anadir_admin.php?error=stmtfailed");
        exit();
    }

    // Pasa los parámetros de la función a los de la consulta SQL
    mysqli_stmt_bind_param($sentencia, "sssssiis", $dni, $nombre, $apellidos, $correo, $contrasena, $edad, $telefono, $tipo);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_close($sentencia);

    // Devuelve "error=none" en el buscador si no hay errores
    header("location:admin.php?error=none");
    exit();
}

/**
 * Cuando el usuario realiza una apuesta de la sección de quinielas, esta se almacena en la tabla de apuestas. Los clientes solo podrán ver las apuestas que hayan realizado desde su cuenta.
 * 
 * @param mysqli $conexion
 * @param string $dni
 * @param string $apuesta
 * @param string $cantidad
 * @param string $fecha
 * @param string $tipo
 * 
 * @return void
 */

// Función que inserta a la tabla de apuestas el tipo de apuesta de quiniela
function quiniela($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo) {
    $sql = "INSERT INTO apuestas (dni, apuesta, cantidad, fecha, tipo) VALUES (?, ?, ?, ?, ?)";
    $sentencia = mysqli_stmt_init($conexion);

    // Muestra error por el buscador si la sentencia no se ejecuta correctamente
    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        header("location:quiniela.php?error=stmtfailed");
        exit();
    }
    
    // Pasa los parámetros de la función a los de la consulta SQL
    mysqli_stmt_bind_param($sentencia, "ssiss", $dni, $apuesta, $cantidad , $fecha, $tipo);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_close($sentencia);

    // Devuelve "error=none" en el buscador si no hay errores
    header("location:cliente.php?error=none");
    exit();
}

/**
 * Esta función almacena la apuesta de máximo goleador en la tabla de apuestas. Cada apuesta se divide en tres tipos (Quiniela, Máximo goleador y Resultado partido)
 * 
 * @param mysqli $conexion
 * @param string $dni
 * @param string $apuesta
 * @param string $cantidad
 * @param string $fecha
 * @param string $tipo
 * 
 * @return void
 */

// Función que inserta a la tabla de apuestas el tipo de apuesta del máximo goleador
function goleador($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo) {
    $sql = "INSERT INTO apuestas (dni, apuesta, cantidad, fecha, tipo) VALUES (?, ?, ?, ?, ?)";
    $sentencia = mysqli_stmt_init($conexion);


    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        // Muestra error por el buscador si la sentencia no se ejecuta correctamente
        header("Location:cliente.php?error=stmtfailed");
    } 

    // Pasa los parámetros de la función a los de la consulta SQL
    mysqli_stmt_bind_param($sentencia, "ssiss", $dni, $apuesta, $cantidad, $fecha, $tipo);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_close($sentencia);

    // Devuelve "error=none" en el buscador si no hay errores
    header("location:cliente.php?error=none");
    exit();
}

/**
 * Al igual que las anteriores funciones de apuestas. Esta se almacena en la tabla de apuestas con su tipo correspondiente. En este caso sería el de "Resultado partido"
 *
 * @param mysqli $conexion
 * @param string $dni
 * @param string $apuesta
 * @param string $cantidad
 * @param string $fecha
 * @param string $tipo
 * 
 * @return void
 */

// Función que inserta a la tabla de apuestas el tipo de apuesta de partido
function partido($conexion, $dni, $apuesta, $cantidad, $fecha, $tipo) {
    $sql = "INSERT INTO apuestas (dni, apuesta, cantidad, fecha, tipo) VALUES (?, ?, ?, ?, ?)";
    $sentencia = mysqli_stmt_init($conexion);

    if (!mysqli_stmt_prepare($sentencia, $sql)) {
        // Muestra error por el buscador si la sentencia no se ejecuta correctamente
        header("location:goleador.php?error=stmtfailed");
        exit();
    }

    // Pasa los parámetros de la función a los de la consulta SQL
    mysqli_stmt_bind_param($sentencia, "ssiss", $dni, $apuesta, $cantidad, $fecha, $tipo);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_close($sentencia);

    // Devuelve "error=none" en el buscador si no hay errores
    header("location:cliente.php?error=none");
    exit();
}


?>