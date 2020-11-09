<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 3 - Ejercicio 4.6</title>
</head>
<body>
    <?php
        if ( $_POST && $_POST["num"] == -1 ) {
            $suma = 0;
            $numeros = explode(",",$_POST["numeros"]);
            echo "Los números son: ";
            foreach ( $numeros as $numero ) {
                echo "$numero ";
                $suma += $numero;
            } 
            echo "<br>La suma es: $suma<br>";
            echo "<a href=''>Volver a empezar</a>";
        } else {
            if ( !$_POST ) {
                $numeros = "";
            } else {
                $numeros = ( $_POST["numeros"] == "" ) ? $_POST["num"] : $_POST["numeros"].",".$_POST["num"];
            }
    ?>

    <form method="post" action="">
        <label for="num">Introduce un número:</label>
        <input type="number" name="num" id="num" autofocus>
        <input type="hidden" id="numeros" name="numeros" value="<?=$numeros?>"><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
        }
    ?>
</body>
</html>