<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas de sprintf</title>
</head>
<body>
    <?php
        $num = 15;
        echo sprintf("%05d",$num),"<br>";
        echo sprintf("%'.05d",$num),"<br>";
        echo sprintf("%'.5d",$num),"<br>";
    ?>
</body>
</html>