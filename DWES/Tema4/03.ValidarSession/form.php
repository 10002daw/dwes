<?php
    $values = [
        "nombre" => "",
        "apellido1" => "",
        "apellido2" => "",
        "usuario" => "",
        "email" => "",
    ];

    if ( $accion == "modificar" && isset($_SESSION["usuario"]) ) {
        foreach ( $values as $input => $value) {
            $values[$input] = $_SESSION[$input];
        }
    }
?>

<form method="post" action="?<?=$accion?>" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="nombre">Nombre: </label></td>
            <td><input name="nombre" id="nombre" value="<?=$values["nombre"]?>"></td>
        </tr>
        <tr>
            <td><label for="apellido1">Primer apellido: </label></td>
            <td><input name="apellido1" id="apellido1" value="<?=$values["apellido1"]?>"></td>
        </tr>
        <tr>
            <td><label for="apellido2">Segundo apellido: </label></td>
            <td><input name="apellido2" id="apellido2" value="<?=$values["apellido2"]?>"></td>
        </tr>
        <tr>
            <td><label for="usuario">Nombre de usuario: </label></td>
            <td><input name="usuario" id="usuario" value="<?=$values["usuario"]?>" <?=$accion=="modificar"?"disabled ":""?>required></td>
        </tr>
        <tr>
            <td><label for="password">Contraseña: </label></td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td><label for="email">Email: </label></td>
            <td><input type="email" name="email" id="email" value="<?=$values["email"]?>"></td>
        </tr>
    </table>
    <input type="submit" value="<?=ucfirst($accion)?>">
</form>
<p>
    <a href="index.php">Volver atrás</a>
</p>