<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> </title>
	<!-- 20 oct. 2020 13:44:35 daw -->
</head>
<body>
<?php
$numeros=str_split(rand(10000,99999));
foreach ($numeros as $num) {
    echo "<img src='images/$num.png' alt='Número $num' width='100' height='100'>";
}
?>
</body>
</html>