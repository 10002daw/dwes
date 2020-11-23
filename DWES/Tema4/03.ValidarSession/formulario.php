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
                
                if ( crearUsuario($nuevo_usuario) ) {
                    $_SESSION['usuario'] = $nuevo_usuario['usuario'];
                    $_SESSION['email'] = $nuevo_usuario['email'];
                    $_SESSION['nombre'] = $nuevo_usuario['nombre'];
                    $_SESSION['apellido1'] = $nuevo_usuario['apellido1'];
                    $_SESSION['apellido2'] = $nuevo_usuario['apellido2'];
                } else {
                    echo "<h1>El usuario ya existe</h1>";
                    header( "refresh:5;url=" );
                }
            } elseif ( isset($_GET["modificar"]) ) {
                $modificaciones = [
                    "nombre" => $_POST["nombre"],
                    "apellido1" => $_POST["apellido1"],
                    "apellido2" => $_POST["apellido2"],
                    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                    "email" => $_POST["email"],
                ];

                modificarUsuarioActual($modificaciones);
            }
        }
    /*
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
                        "apellido1" => $_POST["apellido1"],
                        "apellido2" => $_POST["apellido2"],
                        "usuario" => $_POST["usuario"],
                        "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                        "email" => $_POST["email"],
                    ];

                    array_push($usuarios, $nuevo_usuario);
                    $nuevo_json = json_encode($usuarios, JSON_UNESCAPED_UNICODE);
                    file_put_contents("usuarios.json", $nuevo_json);
                    $_SESSION["usuario"] = $_POST["usuario"];
                    echo "<h1>Usuario creado<h1>";
                    exit;
                }
            }
        } else {
           require_once("form.php");
        }*/

        if ( !isset($_SESSION["usuario"]) ) {
            $accion = "crear";
            require_once("form.php");
        } else {
            if ( $_SESSION["usuario"] != "admin") {
                $accion = "modificar";
                require_once("form.php");
            } else {
                if ( isset($_GET["crear"]) ) {
                    $accion = "crear";
                    require_once("form.php");
                } else {
                    $accion = "modificar";
                    require_once("form.php");
                }
            }
        }
    ?>
</body>
</html>