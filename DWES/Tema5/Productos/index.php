<?php
    require_once('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ( isset($_POST['borrar']) ) {
        $id = $_POST['borrar'];

        if ( $resultado = consulta("DELETE FROM productos.producto WHERE id='$id'") ) {
            echo "Se ha borrado el producto";
        } else {
            echo "ERROR. No se ha podido borrar el producto";
        }
    } elseif ( isset($_POST['crear']) ) {
        /*foreach ( $_POST as $k=>$v) {
            $prod[$k] = $v;
        }*/
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $imagen = $_POST["imagen"];
        $descripcion = $_POST["descripcion"];
        consulta("INSERT INTO producto (nombre, precio, imagen, descripcion) VALUES ('$nombre','$precio','$imagen','$descripcion')");
    } elseif ( isset($_POST['modificar']) ) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $imagen = $_POST["imagen"];
        $descripcion = $_POST["descripcion"];
        consulta("UPDATE producto SET nombre='$nombre', precio='$precio', imagen='$imagen', descripcion='$descripcion' WHERE id='$id'");
    }
    
    require_once("form.php");

    $resultado = consulta("SELECT * FROM productos.producto");

    echo "<table border='1'>\n";
    echo "<tr><th>ID</th><th>Descripción</th><th>Nombre</th><th>Precio</th><th>Imagen</th><th>Editar</th><th>Borrar</th></tr>\n";
    while ( $producto = $resultado->fetch_assoc() ) {
        echo "<tr>\n";
        foreach ( $producto as $campo ) {
            echo "<td>$campo</td>";
        }
    ?>
    <td>
        <form method="post" action="">
            <button type="submit" name="editar" value="<?=$producto['id']?>">Editar</button>
        </form>
    </td>
    <td>
        <form method="post" action="">
            <button type="submit" name="borrar" value="<?=$producto['id']?>">Borrar</button>
        </form>
    </td>
    <?php
        echo "<tr>\n";
    }
    echo "</table>";
    ?>
</body>
</html>