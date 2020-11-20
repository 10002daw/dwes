<?php
    function checkAuth() {
        if ( isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ) {
            $json = file_get_contents("usuarios.json");
            $usuarios = json_decode($json, true);
            foreach ( $usuarios as $usuario ) {
                if ( $usuario['usuario'] == $_SERVER['PHP_AUTH_USER'] && 
                password_verify($_SERVER['PHP_AUTH_PW'], $usuario['password']) ) {
                    return true;
                } 
            }
        } else {
            return false;
        }
    }

    if ( !checkAuth() ) {
        header('WWW-Authenticate: Basic Realm="Contenido restringido"');
        header('HTTP/1.1 401 Unauthorized');
        
        echo "Usuario no reconocido!";
        exit;
    } else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido <?= $_SERVER['PHP_AUTH_USER']; ?></h1>
</body>
</html>
<?php
    }
?>