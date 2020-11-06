<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> </title>
	<!-- 8 oct. 2020 13:06:37 daw -->
</head>
<body>
	<table border="1">
		<caption>Variables de GET</caption>
		<tr><th>Variable</th><th></th><th>Valor</th><th>Tipo</th></tr>
		<?php 
		foreach ($_GET as $clave => $valor) {
		    echo "<tr><td>$clave</td><td>=></td><td>$valor</td><td>",gettype($valor),"</td></tr>";
		}
		?>
	</table>
	<br/>
	<table border="1">
		<caption>Variables de POST</caption>
		<tr><th>Variable</th><th></th><th>Valor</th><th>Tipo</th></tr>
		<?php 
		foreach ($_POST as $clave => $valor) {
		    echo "<tr><td>$clave</td><td>=></td><td>$valor</td><td>",gettype($valor),"</td></tr>";
		}
		?>
	</table>
	<br/>
	<table border="1">
		<caption>Variables de SERVER</caption>
		<tr><th>Variable</th><th></th><th>Valor</th><th>Tipo</th></tr>
		<?php 
		foreach ($_SERVER as $clave => $valor) {
		    echo "<tr><td>$clave</td><td>=></td><td>$valor</td><td>",gettype($valor),"</td></tr>";
		}
		?>
	</table>
</body>
</html>