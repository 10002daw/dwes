<?php

function escribeSelect($name, $array) {
    echo "<select name='$name' id='".$name.">\n";
    foreach ($array as $clave => $valor) {
        echo "<option value='$clave'>$valor</option>\n";
    }
    echo "</select>\n";
}

$meses = [
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre",
];

escribeSelect("mes", $meses);

