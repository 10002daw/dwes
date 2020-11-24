<?php 
    session_start();
    require_once("aux.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php
        if ( $_POST ) {
            if ( isset($_GET["crear"]) ) {
                $nuevo_usuario = [
                    "nombre" => $_POST["nombre"],
                    "apellido1" => $_POST["apellido1"],
                    "apellido2" => $_POST["apellido2"],
                    "usuario" => $_POST["usuario"],
                    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                    "email" => $_POST["email"],
                ];
                
                if ( crearUsuario($nuevo_usuario) && isset($_SESSION["usuario"]) && $_SESSION["usuario"] != "admin" ) {
                    $_SESSION['usuario'] = $nuevo_usuario['usuario'];
                    $_SESSION['email'] = $nuevo_usuario['email'];
                    $_SESSION['nombre'] = $nuevo_usuario['nombre'];
                    $_SESSION['apellido1'] = $nuevo_usuario['apellido1'];
                    $_SESSION['apellido2'] = $nuevo_usuario['apellido2'];
                } else { 
                    echo "<h1>El usuario ya existe</h1>";
                    header( "refresh:5;url=" );
                    exit;
                }

                header("Location: index.php");
                exit;
            } elseif ( isset($_GET["modificar"]) ) {
                $modificaciones = [
                    "nombre" => $_POST["nombre"],
                    "apellido1" => $_POST["apellido1"],
                    "apellido2" => $_POST["apellido2"],
                    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                    "email" => $_POST["email"],
                ];

                if ( modificarUsuarioActual($modificaciones) ) {
                    $_SESSION['email'] = $modificaciones['email'];
                    $_SESSION['nombre'] = $modificaciones['nombre'];
                    $_SESSION['apellido1'] = $modificaciones['apellido1'];
                    $_SESSION['apellido2'] = $modificaciones['apellido2'];
                    header("Location: index.php");
                    exit;
                }
            }
        }

        if ( !isset($_SESSION["usuario"]) ) {
            echo "<h1>Crear usuario</h1>";
            $accion = "crear";
            require_once("form.php");
        } else {
            if ( $_SESSION["usuario"] != "admin") {
                echo "<h1>Modificar información de usuario</h1>";
                $accion = "modificar";
                require_once("form.php");
            } else {
                if ( isset($_GET["crear"]) ) {
                    echo "<h1>Crear usuario</h1>";
                    $accion = "crear";
                    require_once("form.php");
                } else {
                    echo "<h1>Modificar información de usuario</h1>";
                    $accion = "modificar";
                    require_once("form.php");
                }
            }
        }
    ?>
</body>
</html>