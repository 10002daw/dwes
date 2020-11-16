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
            $json = file_get_contents("usuarios.json");
            $usuarios = json_decode($json, true);
            foreach ( $usuarios as $usuario ) {
                if ( $usuario["usuario"] == $_POST["usuario"] ) {
                    echo "<h1>El usuario ya existe</h1>";
                    exit;
                } else {
                    $nuevo_usuario = [
                        "nombre" => $_POST["nombre"],
                        "apellido2" => $_POST["apellido1"],
                        "apellido2" => $_POST["apellido2"],
                        "usuario" => $_POST["usuario"],
                        "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                        "email" => $_POST["email"],
                    ];

                    array_push($usuarios, $nuevo_usuario);
                    $nuevo_json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);
                    file_put_contents("usuarios.json", $nuevo_json);
                    echo "<h1>Usuario creado<h1>";
                    exit;
                }
            }
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