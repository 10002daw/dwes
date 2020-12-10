<?php
    $prod = [
        'id' => '',
        'nombre' => '',
        'precio' => '',
        'imagen' => '',
        'descripcion' => ''
    ];
    if ( isset($_POST['editar']) ) {
        $id = $_POST['editar'];
        $accion = "modificar";

        $resultado = consulta("SELECT * FROM producto WHERE id='$id'");
        $producto = $resultado->fetch_assoc();
        foreach ( $producto as $col=>$campo ) {
            $prod[$col] = $campo;
        }
    } else {
        $accion = "crear";
    }
?>
<form method="post" action="">
    <table>
        <tr>
            <td><label for="id">ID: </label></td>
            <td><input id="id" name="id" value='<?=$prod['id']?>' readonly></td>
        </tr>
        <tr>
            <td><label for="nombre">Nombre: </label></td>
            <td><input id="nombre" name="nombre" value="<?=$prod['nombre']?>"></td>
        </tr>
        <tr>
            <td><label for="precio">Precio: </label></td>
            <td><input id="precio" name="precio" value="<?=$prod['precio']?>"></td>
        </tr>
        <tr>
            <td><label for="imagen">Imagen: </label></td>
            <td><input id="imagen" name="imagen" value="<?=$prod['imagen']?>"></td>
        </tr>
        <tr>
            <td><label for="descripcion">Descripcion: </label></td>
            <td><textarea id="descripcion" name="descripcion"><?=$prod['descripcion']?></textarea></td>
        </tr>
    </table>
    <button type="submit" name="<?=$accion?>"><?=ucfirst($accion)?></button>
</form>