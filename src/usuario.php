<?php

//importamos la conexion a la DB
require "../includes/config/database.php";
$conexion = conectar();

// crear un email y password
$email = "correo@correo.com";
$password = "123456";

//hasheamos la contraseña
$passwordHasheado = password_hash($password, PASSWORD_DEFAULT);
var_dump($passwordHasheado);

// query para crear el usuario
$queryUsuario = "INSERT INTO usuario (email, password) VALUES ('${email}', '${passwordHasheado}');";



//agregar a la base de datos
mysqli_query($conexion, $queryUsuario);