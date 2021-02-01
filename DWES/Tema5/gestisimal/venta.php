<?php
require_once("ProductoModel.php");
require_once("Venta.php");
session_start();

$modelo = new ProductoModel();

if ( isset($_SESSION["venta"]) ) {
    $venta = $_SESSION["venta"];
} else {
    $venta = new Venta();
    $_SESSION["venta"] = $venta;
}

if ( $_POST ) {
    if ( isset($_POST["venta"]) ) {
        $producto = $modelo->getProducto($_POST["codigo"]);
        $cantidad = $_POST["cantidad"];
        $venta->aniadirProducto($producto, $cantidad);
    } elseif ( isset($_POST["borrar"]) ) {
        $producto = $modelo->getProducto($_POST["codigo"]);
        $venta->eliminarProducto($producto);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTISIMAL</title>
</head>
<body>
    <h1>GESTISIMAL</h1>
    <a href="index.php">Ver todos los productos</a>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Precio unidad</th>
            <th>Cantidad</th>
            <th>Precio total</th>
            <th>Precio total IVA</th>
            <th>Borrar</th>
        </tr>
    <?php
        $venta->reset();
        while ( $ventaProd = $venta->current() ) {
    ?>
        <tr>
            <td><?=$ventaProd["producto"]->getCodigo()?></td>
            <td><?=$ventaProd["producto"]->getDescripcion()?></td>
            <td><?=$ventaProd["producto"]->getPventa()?>€</td>
            <td><?=$ventaProd["cantidad"]?></td>
            <td><?=round($venta->currentPrecio(),2)?>€</td>
            <td><?=round($venta->currentPrecioIva(),2)?>€</td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="codigo" value="<?=$ventaProd["producto"]->getCodigo()?>">
                    <button type="submit" name="borrar">Borrar</button>
                </form>
            </td>
        </tr>     
    <?php
            $venta->next();
        }
    ?>
        <tr>
            <td colspan="5"></td>
            <td><?=round($venta->precioTotal(),2)?>€</td>
            <td></td>
        </tr>
    </table>
</body>
</html>