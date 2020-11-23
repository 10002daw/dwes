<?php 
    session_start();

    if ( !isset($_SESSION['usuario']) ) {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar datos de usuario</title>
</head>
<body>
    <h1>Datos de usuario</h1>
    <table>
        <tr>
            <td>Nombre de usuario: </td>
            <td><?= $_SESSION['usuario']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?= $_SESSION['email']?></td>
        </tr>
        <tr>
            <td>Nombre: </td>
            <td><?= $_SESSION['nombre']?></td>
        </tr>
        <tr>
            <td>Primer apellido: </td>
            <td><?= $_SESSION['apellido1']?></td>
        </tr>
        <tr>
            <td>Segundo apellido: </td>
            <td><?= $_SESSION['apellido2']?></td>
        </tr>
    </table>
    <p>
        <a href="index.php">Volver atrás</a>
    </p>
</body>
</html>