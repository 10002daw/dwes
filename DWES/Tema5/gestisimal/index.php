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
    <?php
        $modelo = new ProductoModel();
        $producto = $modelo->getProducto("h001");
        echo $producto->toString();
    ?>
</body>
</html>