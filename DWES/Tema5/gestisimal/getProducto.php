<?php

require_once("ProductoModel.php");

$modelo = new ProductoModel();
$arrayProducto=[];
if ( isset($_GET["p"]) ) {
    if ( $producto = $modelo->getProducto($_GET["p"]) ) {
        $arrayProducto[] = $producto->getArray();
    }
}

echo json_encode($arrayProducto, JSON_UNESCAPED_UNICODE);