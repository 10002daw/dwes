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

function crearUsuario($usuario) {    
    if ( buscarUsuario($usuario["usuario"]) ) {
        return false;
    }

    $json = file_get_contents("usuarios.json");
    $usuarios = json_decode($json, true);

    array_push($usuarios, $usuario);

    $nuevo_json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    file_put_contents("usuarios.json", $nuevo_json);
    
    return $usuario;
}

function modificarUsuarioActual($modificaciones) {
    $username = $_SESSION["usuario"];

    $json = file_get_contents("usuarios.json");
    $usuarios = json_decode($json, true);

    for ( $i = 0; $i < count($usuarios); $i++ ) {
        if ( $usuarios[$i]["usuario"] == $username ) {
            $usuarios[$i]["nombre"] = $modificaciones["nombre"];
            $usuarios[$i]["apellido1"] = $modificaciones["apellido1"];
            $usuarios[$i]["apellido2"] = $modificaciones["apellido2"];
            $usuarios[$i]["email"] = $modificaciones["email"];
            $usuarios[$i]["password"] = $modificaciones["password"];
            
            $nuevo_json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);
            file_put_contents("usuarios.json", $nuevo_json);

            return true;
        }
    }

    return false;
}