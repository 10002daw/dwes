<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> </title>
	<!-- 19 oct. 2020 10:02:47 daw -->
</head>
<body>
<?php
//echo "<h1>Sorteo del día ",date('l j \d\e F Y'),"</h1>";
setlocale(LC_TIME, "es_ES.UTF-8");
echo "<h1>Sorteo del ",strftime('%A %e de %B del %Y'),"</h1>";
$num[0]=rand(1,49);
for($i=0; $i<5; $i++) {
    do {
        $aux=rand(1,49);
    } while(in_array($aux,$num));
    $num[count($num)]=$aux;
}
sort($num);
echo "<p>Los números son: </p>";
echo "<table border='1'><tr>";
foreach ($num as $n) {
    echo "<td>$n</td>";
}
echo "</tr></table>";
?>
</body>
</html>