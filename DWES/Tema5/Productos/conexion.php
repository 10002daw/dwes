<?php

function conexion() {
    $host="localhost";
    $usuario="productos";
    $pass="productos2020";
    $bd="productos";

    @ $conexion = new mysqli($host, $usuario, $pass, $bd);
    
    if ( $conexion->connect_errno != null ) {
        return null;
    }

    $conexion->set_charset("utf8");
    return $conexion;
}

function consulta($q) {
    $conexion = conexion();
    $resultado = $conexion->query($q);
    $conexion->close();
    return $resultado;
}

$con = conexion();