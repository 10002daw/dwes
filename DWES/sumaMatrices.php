<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> </title>
	<style type="text/css">
	   table { border: 1px solida black; }
	</style>
	<!-- 15 oct. 2020 13:14:38 daw -->
</head>
<body>
<?php
function tablaInputs($f, $c) {
    echo "<table>\n";
    for ($i=0; $i<$f; $i++) {
        echo "<tr>\n";
        for ($j=0; $j<$f; $j++) {
            echo "<td><input type='number' name='a[][]' size='6'\></td>\n";
        }   
        echo "</tr>\n";
    }
    echo "</table>\n";
    echo "<input type='hidden' name='fil' value='$f'/>";
    echo "<input type='hidden' name='col' value='$c'/>";
}
if ($_GET) {
    $f = $_GET['f'];
    $c = $_GET['c'];
    tablaInputs(3,3);
} else {
    echo "<p style='color:red; font-size:16pt;'>Error</p>";
}
?>
</body>
</html>