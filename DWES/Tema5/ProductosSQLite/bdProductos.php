<?php
function mensajeError($mensaje) {
    echo "<span style='color:red; font-size: 18pt;'>$mensaje</span>";
    echo "<br/><a href='javascript:window.history.back();'>Volver Atrás</a><br/>";
}
function establecerConexion($sgbd="sqlite") {
    if ( $sgbd == "mysql" ) {
        try {
            [$host,$usuario,$passwd,$bd]=['localhost','productos','productos2020','productos'];
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
function consulta($sql, $sgbd="sqlite") {
    $conexion=establecerConexion($sgbd);
    $tipo = explode(" ",trim(strtoupper($sql)))[0];
    if ( $tipo == "SELECT") {
        $resultado = $conexion->query($sql);
    } else {
        $resultado = $conexion->exec($sql);
        echo $conexion->errorInfo()[2]."<br>";
    }

    return $resultado;
}
?>
