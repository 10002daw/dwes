<?php
function generarNumerosAleatorios($numItems, $limiteInf, $limiteSup) {
    $res=[];
    
    while (count($res)<$numItems) {
        $numAleatorio = rand($limiteInf, $limiteSup);
        if (!in_array($numAleatorio, $res)) {
            //$res[count($res)] = $numAleatorio;
            array_push($res, $numAleatorio);
        }
    }
    
    return $res;
}