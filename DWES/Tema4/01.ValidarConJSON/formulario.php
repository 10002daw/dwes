<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if ( $_POST ) {
            if ( !$handle = fopen("usuarios","r") ) {
                echo "No se ha podido abrir el archivo";
            }
            while ( $linea=fgets($handle) ) {
                $json = json_decode($linea,true);
                if ( $json["usuario"] == $_POST["usuario"] ) {
                    echo "El usuario ya existe";
                }
            }
            fclose($handle);
        } else {
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nombre">Nombre: </label></td>
                <td><input name="nombre" id="nombre"></td>
            </tr>
            <tr>
                <td><label for="apellido1">Primer apellido: </label></td>
                <td><input name="apellido1" id="apellido1"></td>
            </tr>
            <tr>
                <td><label for="apellido2">Segundo apellido: </label></td>
                <td><input name="apellido2" id="apellido2"></td>
            </tr>
            <tr>
                <td><label for="usuario">Nombre de usuario: </label></td>
                <td><input name="usuario" id="usuario" required></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña: </label></td>
                <td><input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
                <td><label for="email">Email: </label></td>
                <td><input type="email" name="email" id="email"></td>
            </tr>
        </table>
        <input type="submit" value="Enviar">
    </form>
    <?php
        }
    ?>
</body>
</html>