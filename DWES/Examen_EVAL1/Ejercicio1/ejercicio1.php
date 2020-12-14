<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form method="post" action="">
        <label for="n1">Primer número:</label>
        <input id="n1" name="n1">
        <br>
        <label for="n2">Segundo número:</label>
        <input id="n2" name="n2">
        <button type="submit">Enviar</button>
    </form>

    <?php
        if ( $_POST && isset($_POST["n1"]) && isset($_POST["n2"]) ) {
            $n1 = $_POST["n1"];
            $n2 = $_POST["n2"];
    ?>
    <table border="1">
        <tr>
            <td><?=$n1?>+<?=$n2?></td>
            <td><?=$n1+$n2?></td>
        </tr>
        <tr>
            <td><?=$n1?>*<?=$n2?></td>
            <td><?=$n1*$n2?></td>
        </tr>
        <tr>
            <td>Media(<?=$n1?>,<?=$n2?>)</td>
            <td><?=($n1+$n2)/2?></td>
        </tr>
    </table>
    <?php      
        }
    ?>
</body>
</html>