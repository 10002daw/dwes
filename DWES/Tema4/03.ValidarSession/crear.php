<?php
session_start();

require_once("aux.php");

$nuevo_usuario = [
    "nombre" => $_POST["nombre"],
    "apellido1" => $_POST["apellido1"],
    "apellido2" => $_POST["apellido2"],
    "usuario" => $_POST["usuario"],
    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
    "email" => $_POST["email"],
];

if ( crearUsuario($nuevo_usuario) ) {
    $_SESSION['usuario'] = $usuario['usuario'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellido1'] = $usuario['apellido1'];
    $_SESSION['apellido2'] = $usuario['apellido2'];
} 