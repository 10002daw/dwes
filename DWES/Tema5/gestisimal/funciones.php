<?php

function establecerConexion($sgbd="mysql") {
    if ( $sgbd == "mysql" ) {
        try {
            [$host,$usuario,$passwd,$bd]=['localhost','gestisimal','gestisimal2021','gestisimal'];
            $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
        } catch (PDOException $ex) {
            mensajeError("Error estableciendo conexión con la base de datos: $bd.");
        }
    } elseif ( $sgbd == "sqlite" ) {
        try {
            $bd = "/var/www/phpdata/productos.sqlite";
            $conexion = new PDO("sqlite:$bd");
        } catch (PDOException $ex) {
            mensajeError("Error estableciendo conexión con la base de datos: $bd.");
        }        
    }

    return $conexion;
}