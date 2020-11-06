<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="1">-->
    <title>Ejercicio 4.2</title>
</head>
<body>
    <?php
        function mostrarImgNum($num) {
            echo "<img src='images/numeros/$num.png' alt='Número $num' width='30' height='30'>";
        }

        function mostrarNum($num) {
            $num = sprintf("%02d",$num);
            foreach ( str_split($num) as $n ) {
                mostrarImgNum($n);
            }
        }
        
        $fecha = getdate();
        mostrarNum($fecha["year"]);
        echo " - ";
        mostrarNum($fecha["mon"]);
        echo " - ";
        mostrarNum($fecha["mday"]);
        echo "<br>";
        mostrarNum($fecha["hours"]);
        echo ":";
        mostrarNum($fecha["minutes"]);
        echo ":";
        mostrarNum($fecha["seconds"]);
    ?>
</body>
</html>