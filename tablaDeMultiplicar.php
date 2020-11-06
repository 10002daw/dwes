<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Hola Mundo</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<table>
		<?php
			$numero=1;
			$numero=$_GET["num"];
			for($i=1; $i<=10; $i++) {
				echo "<tr><td>$numero</td><td>*</td><td>$i</td><td>=</td><td>",$numero*$i,"</td></tr>\n";
			}
		?>
		</table>
	</body>
</html>
