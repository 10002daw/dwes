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

function getCaracteristicas($conexion, $tabla) {
    $sgbd = $conexion->getAttribute(PDO::ATTR_DRIVER_NAME);
    
    if ( $sgbd == "sqlite" ) {
        $sql = "pragma table_info('$tabla');";
        $resultado = $conexion->query($sql);
        $columnas["nombre"] = "name";
        $columnas["tipo"] = "type";
    } elseif ( $sgbd == "mysql" ) {
        $sql = "describe $tabla;";
        $resultado = $conexion->query($sql);
        $columnas["nombre"] = "Field";
        $columnas["tipo"] = "Type";
    }

    while ( $campo = $resultado->fetch(PDO::FETCH_ASSOC) ) {
        $nombre = $campo[$columnas["nombre"]];
        $tipoCompleto = $campo[$columnas["tipo"]];
        //echo $nombre." ".$tipo."<br>";
        preg_match("/(\w*)\(?(\d*)?/",$tipoCompleto,$matches);
        $tipo = $matches[1];
        $tamanio = $matches[2];
        $esNumero = ($tipo=="int" || $tipo=="INTEGER" || strtolower($tipo)=="decimal");
        //print_r($matches);
        //echo "<br>";
        $inputs[$nombre]["size"] = ( $tamanio=="" )? 9 : $tamanio;
        $inputs[$nombre]["type"] = $tipo;
        $inputs[$nombre]["align"] = ( $esNumero )? "right" : "left";
    }
    
    echo("<pre>");
    print_r($inputs);
    echo("</pre><br>");

    return $inputs;
}
getCaracteristicas(establecerConexion("mysql"),"producto");
getCaracteristicas(establecerConexion("sqlite"),"producto");
?>
