<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Hola Mundo</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<table>
		<?php
			$numero=7;
			for($i=1; $i<=10; $i++) {
				echo "<tr><td>$numero</td><td>*</td><td>$i</td><td>=</td><td>",$numero*$i,"</td></tr>\n";
			}
		?>
		</table>
	</body>
</html>
