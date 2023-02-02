CREATE DATABASE Casa;
use Casa;

GRANT ALL PRIVILEGES ON Casa.* TO mike@"%" IDENTIFIED BY "idklol";
FLUSH PRIVILEGES;

CREATE TABLE usuarios(
    dni VARCHAR(9) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(30) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    contrasena VARCHAR(50) NOT NULL,
    edad INT(3) NOT NULL,
    telefono INT(9) NOT NULL,
    tipo VARCHAR(20) DEFAULT "cliente"
);

CREATE TABLE apuestas(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(9) NOT NULL,
    apuesta VARCHAR(200)NOT NULL,
    cantidad INT(11) NOT NULL,
    fecha VARCHAR(100) NOT NULL,
    tipo VARCHAR(30) NOT NULL,
    FOREIGN KEY(dni) REFERENCES usuarios(dni)
);

INSERT INTO usuarios (dni, nombre, apellidos, correo, contrasena, edad, telefono, tipo) 
VALUES ("123456789M", "Pepe", "Juanito", "pepejuan@gmail.com", "pepe", 34, 928671104, "admin");
