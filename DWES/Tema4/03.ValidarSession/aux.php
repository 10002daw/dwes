<?php

function buscarUsuario($nombreUsuario) {
    $json = file_get_contents("usuarios.json");
    $usuarios = json_decode($json, true);

    foreach ( $usuarios as $usuario ) {
        if ( $usuario["usuario"] == $nombreUsuario ) {
            return $usuario;
        }
    }

    return false;
}

function verificar($nombreUsuario, $password) {
    if ( $usuario = buscarUsuario($nombreUsuario) ) {
        if ( password_verify($password, $usuario['password']) ) {
            return $usuario;
        }
    }

    return false;
}