<?php 
require_once("ProductoModel.php");

$productosPorPagina = 5;
$modelo = new ProductoModel($productosPorPagina);
$numProductos = $modelo->getNumProductos();
$numPaginas = intval(ceil($numProductos/$productosPorPagina));
$paginaActual = isset($_GET["p"]) ? $_GET["p"] : 1;
if ( $paginaActual < 1 ) {
    $paginaActual = 1;
} elseif ( $paginaActual > $numPaginas ) {
    $paginaActual = $numPaginas;
}

if ( isset($_POST["crear"]) ) {
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];
    $pcompra = $_POST["pcompra"];
    $pventa = $_POST["pventa"];
    $stock = $_POST["stock"];
    $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
    $modelo->crearProducto($producto);
} elseif ( isset($_POST["borrar"]) ) {
    $codigo = $_POST["codigo"];
    $modelo->borrarProducto($codigo);
} elseif ( isset($_POST["editar"]) ) {
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];
    $pcompra = $_POST["pcompra"];
    $pventa = $_POST["pventa"];
    $stock = $_POST["stock"];
    $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
    if ( $modelo->guardarProducto($producto) ) {
        $arrayProducto[]  = $producto->getArray();
        echo json_encode($arrayProducto, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        echo json_encode(array(), JSON_UNESCAPED_UNICODE);
        exit;
    }
} elseif ( isset($_POST["entrada"]) ) {
    $codigo = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $producto = $modelo->getProducto($codigo);
    $producto->aumentarStock($cantidad);
    if ( $modelo->guardarProducto($producto) ) {
        $arrayProducto[]  = $producto->getArray();
        echo json_encode($arrayProducto, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        echo json_encode(array(), JSON_UNESCAPED_UNICODE);
        exit;
    }
} elseif ( isset($_POST["salida"]) ) {
    $codigo = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $producto = $modelo->getProducto($codigo);
    if ( $producto->disminuirStock($cantidad) ) {
        if ( $modelo->guardarProducto($producto) ) {
            $arrayProducto[]  = $producto->getArray();
            echo json_encode($arrayProducto, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            echo json_encode(array(), JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        echo json_encode(array(), JSON_UNESCAPED_UNICODE);
        exit;
    }    
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTISIMAL</title>
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
        <div id="pruebas"></div>
    <h1>GESTISIMAL</h1>
    <a href="venta.php">Ver venta</a>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Prcompra</th>
                <th>Pventa</th>
                <th>Margen</th>
                <th>Stock</th>
                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $productos = $modelo->getProductos($paginaActual);
                foreach ( $productos as $producto ) {
                    $codigo = $producto->getCodigo();
                    $descripcion = $producto->getDescripcion();
                    $pcompra = $producto->getPcompra();
                    $pventa = $producto->getPventa();
                    $margen = $producto->getMargen();
                    $stock = $producto->getStock();
            ?>
            <tr>
                <form action="" method="post" id="<?=$codigo?>">
                    <td>
                        <input type="text" name="codigo" id="codigo-<?=$codigo?>" size="4" maxlength="4" value="<?=$codigo?>" readonly required>
                    </td>
                    <td>
                        <input type="text" name="descripcion" id="descripcion-<?=$codigo?>" size="30" value="<?=$descripcion?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="pcompra" id="pcompra-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" min="0" step="0.01" size="10" value="<?=$pcompra?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="pventa" id="pventa-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" min="0" step="0.01" size="10" value="<?=$pventa?>" readonly required>
                    </td>
                    <td>
                        <input type="number" step="0.01" id="margen-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" size="10" value="<?=$margen?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="stock" id="stock-<?=$codigo?>" min="0" size="5" value="<?=$stock?>" readonly required>
                    </td>
                    <td>
                        <input type="hidden" name="editar" value="" readonly>
                        <button type="button" name="editar" onclick="habilitar('<?=$codigo?>',this)">Editar</button>
                    </td>
                </form>
                <td>
                    <form action="" method="post" onsubmit="return eliminar('<?=$codigo?>');">
                        <input type="hidden" name="codigo" value="<?=$codigo?>">
                        <button type="submit" name="borrar">Eliminar</button>
                    </form>
                </td>
                <td>
                    <button type="button" onclick="entradaStock('<?=$codigo?>', <?=$stock?>)">Entrada</button>
                </td>
                <td>
                <!--    <button type="button" onclick="venta('<?=$codigo?>', <?=$stock?>)">Venta</button> -->
                    <button type="button" onclick="salidaStock('<?=$codigo?>', <?=$stock?>)">Salida</button>
                </td>
            </tr>
            <?php
                }
            ?>

            <!-- Insertar producto -->
            <tr>
                <form action="" method="post" onsubmit="return validar();">
                    <td><input type="text" name="codigo" id="codigo" size="5" maxlength="5" required></td>
                    <td><input type="text" name="descripcion" size="30" required></td>
                    <td><input type="number" oninput="calcularMargen('nuevo');" name="pcompra" id="pcompra-nuevo" min="0" step="0.01" size="10" required></td>
                    <td><input type="number" oninput="calcularMargen('nuevo');" name="pventa" id="pventa-nuevo" min="0" step="0.01" size="10" required></td>
                    <td><input type="number" id="margen-nuevo" step="0.01" size="10" disabled></td>
                    <td><input type="number" name="stock" min="0" size="5" required></td>
                    <td colspan="2">
                        <button type="submit" name="crear">Nuevo producto</button>
                    </td>
                    <td id="mensajeError" colspan="2"></td>
                </form>
            </tr>

            <!-- Paginación -->
            <tr>
                <td>Página <?=$paginaActual?> de <?=$numPaginas?></td>
                <td></td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="1">
                        <button type="submit">Primera</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$paginaActual-1?>">
                        <button type="submit">Anterior</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$paginaActual+1?>">
                        <button type="submit">Siguiente</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$numPaginas?>">
                        <button type="submit">Última</button>
                    </form>
                </td>
                <td colspan="4">
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>