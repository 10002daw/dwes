<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php

    function leerNotas($fichero) {
        $notas = [];
        $handle = fopen($fichero,"r");
        while ( $linea = fgets($handle) ) {
            $nota = explode(",",$linea);
            $notas[$nota[0]] = $nota[1];
        }
        return $notas;
    }

    $notas = leerNotas("notas.txt");
    arsort($notas, SORT_NUMERIC);

    echo "<table border='1'>\n";
    foreach ( $notas as $alumno => $nota) {
        echo "<tr>\n";
        echo "<td>$alumno</td>\n";
        echo "<td>$nota</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
    ?>
</body>
</html>