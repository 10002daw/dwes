<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $host="localhost";
        $usuario="productos";
        $pass="productos2020";
        $bd="productos";

        $conexion = new mysqli($host, $usuario, $pass, $bd);
        $resultado = $conexion->query("SELECT * FROM productos.producto");
        $conexion->set_charset("utf8");
        echo "<table border='1'>\n";
        echo "<tr><th>ID</th><th>Descripción</th><th>Nombre</th><th>Precio</th><th>Imagen</th></tr>\n";
        while ( $producto = $resultado->fetch_assoc() ) {
            echo "<tr>\n";
            foreach ( $producto as $campo ) {
                echo "<td>$campo</td>";
            }
            echo "<tr>\n";
        }
        echo "</table>";
        $conexion->close();
    ?>
</body>
</html>