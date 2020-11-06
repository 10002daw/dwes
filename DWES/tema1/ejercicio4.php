<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> </title>
	<!-- 22 oct. 2020 10:22:29 daw -->
</head>
<body>
<?php
require_once("./funcionesAuxiliares/funcionesAux.php");

$cartas = generarNumerosAleatorios(10,1,48);
$puntos = 0;
$palos=["bastos","copas","espadas","oros"];

foreach ($cartas as $carta) {
    $palo = $palos[floor(($carta-1)/12)];

    $num = ($carta%12 == 0)? 12 : $carta%12;
    switch ($num) {
        case 1:
            $puntos+=11;
            break;
        case 3:
            $puntos+=10;
            break;
        case 12:
            $puntos+=4;
            break;
        case 11:
            $puntos+=3;
            break;
        case 10:
            $puntos+=2;
            break;
    }
    
    echo "<img src='images/barajaEspa/$palo/$palo$num.png' width='10%' height='10%'>";
}
echo "<h1>La puntuación total es $puntos</h1>";
?>
</body>
</html>