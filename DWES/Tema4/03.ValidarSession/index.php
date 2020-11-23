<?php
    session_start();
    require_once("aux.php");

    if ( $_POST ) {
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        if ( $usuario = verificar($username, $password) ) {
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido1'] = $usuario['apellido1'];
            $_SESSION['apellido2'] = $usuario['apellido2'];
        } else {
            echo "El usuario no existe o la contraseña es incorrecta";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php
        if ( !isset($_SESSION['usuario']) ) {
    ?>
    <p>
        <a href="formulario.php">Crear nuevo usuario</a>
    </p>
    <form method="post" action="">
        <table>
            <tr>
                <td><label for="usuario">Usuario:</label></td>
                <td><input id="usuario" name="usuario"></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password"></td>
            </tr>
        </table>
        <input type="submit" value="Validar">
    </form>
    <?php
        } else {
    ?>
    <p>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </p>
    <p>
        <a href="consultar.php">Consultar información de usuario</a>
    </p>
    <p>
        <a href="formulario.php?modificar">Editar información de usuario</a>
    </p>
    <?php
            if ( $_SESSION['usuario'] == "admin" ) {
    ?>
    <p>
        <a href="formulario.php?crear">Dar de alta a un usuario</a>
    </p>
    <?php
            }
        }
    ?>
</body>
</html>