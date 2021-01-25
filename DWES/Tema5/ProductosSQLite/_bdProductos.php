<?php
function mensajeError($mensaje) {
    echo "<span style='color:red; font-size: 18pt;'>$mensaje</span>";
    echo "<br/><a href='javascript:window.history.back();'>Volver Atrás</a><br/>";
}
function establecerConexion() {
    [$host,$usuario,$passwd,$bd]=['localhost','productos','productos2020','productos'];
    $conexion=new mysqli($host,$usuario,$passwd,$bd);
    $conexion->set_charset("utf8");
    if ($conexion->errno!=null) {
        mensajeError("Error estableciendo conexión con la base de datos: $bd.");
        exit();
    }
    return $conexion;
}
function consulta($sql) {
    $conexion=establecerConexion();
    $resultado=$conexion->query($sql);
    if (!$resultado) {
        mensajeError("Error ejecutando consulta: $sql.");
        exit();
    }
    return $resultado;
}
?>
