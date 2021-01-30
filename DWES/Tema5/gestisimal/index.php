<?php 
require_once("ProductoModel.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTISIMAL</title>
</head>
<body>
    <h1>GESTISIMAL</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Margen</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $modelo = new ProductoModel();
                $productos = $modelo->getProductos();
                foreach ( $productos as $producto ) {
                    echo $producto->toTr();
                }
            ?>
        </tbody>
    </table>
</body>
</html>