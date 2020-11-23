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
/* usar un bucle for para buscar la posición y luego editarla */
    foreach ( $usuarios as $usuario ) {
        if ( $usuario["usuario"] == $username ) {
            $usuario_modificado["nombre"] = $modificaciones["nombre"];
            $usuario_modificado["apellido1"] = $modificaciones["apellido1"];
            $usuario_modificado["apellido2"] = $modificaciones["apellido2"];
            $usuario_modificado["email"] = $modificaciones["email"];
            $usuario_modificado["password"] = $modificaciones["password"];
            print_r(array($usuario));
            array_diff($usuarios, array($usuario));
            echo "<br><br>";
            break;
        }
    } 
    print_r($usuarios);
    echo "<br><br>";
    $nuevo_json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    file_put_contents("usuarios.json", $nuevo_json);
    
    return $usuario;
}