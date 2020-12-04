<?php
require_once("Carrito.php");
session_start();

$p1 = new Producto(
    1,
    "Pelikan Souvëran M-1000",
    545,
    "images/pelikan.png",
    "La estilográfica Pelikan Souveran M1000 verde es el modelo más grande que presenta la colección Souveran. Con unas medidas de 147 mm (larga cerrada), 173 mm (posteada), 13,8 mm de diámetro.El modelo se ha convertido en la referencia para todos los amantes de las plumas estilográficas y sobre todo para los coleccionistas de la firma alemana."
);

$p2 = new Producto(
    2,
    "Parker Duofold International",
    406,
    "images/parker.png",
    "Parker Duofold International Black GT ha sido el emblema de la impresionante artesanía y patrimonio de Parker. Con un acabado en resina preciosa, negro profundo. Parker Duofold Ofrece una experiencia de escritura de lujo y una comodidad excepcionales gracias a su plumín de oro macizo de 18 quilates."
);

$p3 = new Producto(
    3,
    "Visconti Van Gogh",
    180,
    "images/visconti.png",
    "La pluma estilográfica Visconti Van Gogh Room in Arles está realizada con resina variegada evocando el cuadro 'Habitación en Arles'. Cuerpo tallado en 36 caras. Fornituras cromadas en paladio. Cierre del capuchón por imán. Plumín de acero de alta calidad grabado con el anagrama de la marca. Carga mediante cartucho universal o convertidor. Longitud 14 cm cerrada. Peso 35 g. Diámetro 1,5 cm."
);

$productos = [
    1 => $p1,
    2 => $p2,
    3 => $p3
];

if ( isset($_SESSION["carrito"]) ) {
    $carrito = $_SESSION["carrito"];
} else {
    $carrito = new Carrito();
    $_SESSION["carrito"] = $carrito;
}

if ( $_POST ) {
    if ( isset($_POST["comprar"]) ) {
        $carrito->aniadirProducto($productos[$_POST["comprar"]]);
    } elseif ( isset($_POST["borrar"]) ) {
        $carrito->eliminarProducto($productos[$_POST["borrar"]]);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Estilográfica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header></header>

    <main>
        <section id="productos">
            <h2>Productos</h2>
            <hr>
            <?php
            foreach ( $productos as $producto ) {
                echo "<article>\n";
                echo $producto->productoToHTML();
                echo "<form method='post' action=''>";
                echo "<button type='submit' name='comprar' value='".$producto->getId()."'>Comprar</button>";
                echo "</form>";
                echo "<a href='detalles.php?id=".$producto->getId()."'><button>Detalles</button></a>";
                echo "</article>\n";
            }
            ?>
        </section>

        <aside class="carrito clearfix">
            <h2>Carrito</h2>
            <hr>
            <?php
            $carrito->reset();
            while ( $carritoProd = $carrito->current() ) {
                echo "<article>\n";
                echo $carritoProd["producto"]->productoToHTML();
                echo "<p>Unidades: ".$carritoProd["cantidad"]."</p>";
                echo "<form method='post' action=''>";
                echo "<button type='submit' name='borrar' value='".$carritoProd["producto"]->getId()."'>Eliminar</button>";
                echo "</form>";
                echo "</article>\n";
                $carrito->next();
            }
            ?>
            <p>Total: <?=$carrito->precioTotal()?></p>
        </aside>
    </main>
</body>
</html>