<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function listaProductosPDOsqlite3() {
            $conexion=new PDO("sqlite:/var/www/phpdata/productos.sqlite");
            $resultado=$conexion->query("select * from producto");
            $resultado->bindColumn(1,$id); $resultado->bindColumn(2,$descripcion); $resultado->bindColumn(3,$nombre);
            $resultado->bindColumn(4,$precio); $resultado->bindcolumn(5,$imagen);
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Descripción</th><th>Nombre</th><th>Precio</th><th>Imagen</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($registro=$resultado->fetch(PDO::FETCH_BOUND)) {
            echo "<tr><td>$id</td><td>$descripcion</td><td>$nombre</td><td>$precio</td><td>$imagen</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }

        listaProductosPDOsqlite3();
    ?>
</body>
</html>