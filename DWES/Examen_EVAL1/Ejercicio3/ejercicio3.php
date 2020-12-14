<?php 
    session_start(); 

    //Función que recibe un nombre de usuario y una contraseña, y devuelve true si el usuario existe y la contraseña coincide, y false en caso contrario
    function comprobarUsuario($usuario, $password) {
        $handle=fopen("usuarios.txt","r");
        while ( $linea = fgets($handle) ) {
            $datos = json_decode($linea,true);
            if ( $datos["usuario"] == $usuario ) {
                if ( password_verify($password, $datos["hash"]) ) {
                    fclose($handle);
                    return true;
                } else {
                    fclose($handle);
                    return false;
                }
            }
        }
        fclose($handle);
        return false;
    }

    //Función que recibe un nombre de usuario y una contraseña
    //Cambia la contraseña del usuario dado por la contraseña pasada por parámetro
    function cambiarPassword($usuario, $password) {
        $tmpFile = tempnam("/tmp","tmpUsuarios"); //Creamos un fichero temporal
        $tmpHandle = fopen($tmpFile,"w"); 
        $handle = fopen("usuarios.txt","r");

        //Copiamos en el fichero temporal todos los usuarios excepto al que vamos a cambiarle la contraseña
        while ( $linea = fgets($handle) ) {
            $datos = json_decode($linea,true);
            if ( $datos["usuario"] != $usuario ) {
                fputs($tmpHandle, $linea);
            }
        }

        //Añadimos al final del fichero temporal al usuario con la contraseña cambiada
        $json = [
            "usuario" => $usuario,
            "hash" => password_hash($password, PASSWORD_BCRYPT)
        ]; 
        $linea = json_encode($json, JSON_UNESCAPED_UNICODE);
        fputs($tmpHandle, $linea."\n");

        fclose($tmpHandle);
        fclose($handle);
        unlink("usuarios.txt"); //Borramos la "base de datos"
        rename($tmpFile, "./usuarios.txt"); //Movemos el fichero temporal para cambiarlo por la "base de datos"
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <?php
        //Comprobamos si se han mandado datos por POST
        //Diferencio cual de los dos formulario se ha enviado porque uno manda la variable $_POST["usuario"] y el otro no
        //Además, compruebo si hay algún usuario logeado si se intenta cambiar una contraseña
        if ( $_POST ) {
            if ( isset($_POST["usuario"]) && isset($_POST["password"])) {
                if ( comprobarUsuario($_POST["usuario"], $_POST["password"]) ) {
                    $_SESSION["usuario"] = $_POST["usuario"];
                } else {
                    echo "El usuario no existe o la contraseña no coincide<br>";
                }
            } elseif ( $_SESSION && isset($_SESSION["usuario"]) && isset($_POST["password"]) && isset($_POST["password2"]) ) {
                if ( $_POST["password"] != $_POST["password2"] ) {
                    echo "Las contraseñas no coinciden";
                } else {
                    cambiarPassword($_SESSION["usuario"], $_POST["password"]);
                    session_destroy();
                    header("Location: ");
                }
            }
        }

        if ( $_SESSION && isset($_SESSION["usuario"]) ) {
    ?>
    <form method="post" action="">
        <label for="usuario">Tu usuario:</label>
        <input id="usuario" value="<?=$_SESSION["usuario"]?>" disabled>
        <br>
        <label for="password">Nueva contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="password2">Repite la contraseña:</label>
        <input type="password" id="password2" name="password2" required>
        <br>
        <button type="submit">Enviar</button>
    </form>
    <?php
        } else {
    ?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label>
        <input id="usuario" name="usuario" require>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
    <?php
        }
    ?>  
</body>
</html>