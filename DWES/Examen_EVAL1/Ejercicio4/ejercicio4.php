<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
        function getConexion() {
            $host="localhost";
            $usuario="instituto";
            $pass="instituto2020";
            $bd="instituto";

            @ $conexion = new mysqli($host, $usuario, $pass, $bd);
            
            if ( $conexion->connect_errno != null ) {
                return null;
            }

            $conexion->set_charset("utf8");
            return $conexion;
        }

        //Función a la que le pasas los resultados de una consulta de alumnos e imprime una tabla html con los datos
        function imprimirTabla($resultado) {
            echo "<table border='1'>\n";
            echo "<tr><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Nota</th></tr>\n";
            while ( $alumno = $resultado->fetch_assoc() ) {
                echo "<tr>\n";
                echo "<td>",$alumno['nombre'],"</td>\n";
                echo "<td>",$alumno['ap1'],"</td>\n";
                echo "<td>",$alumno['ap2'],"</td>\n";
                echo "<td>",$alumno['nota'],"</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
        }

        $conexion = getConexion();

        $query1 = "SELECT * FROM alumnos WHERE nota >= 5 ORDER BY nota DESC";
        $resultado = $conexion->query($query1);
        echo "<h2>Alumnos aprobados</h2>\n";
        imprimirTabla($resultado);

        echo "<br>\n";

        $query1 = "SELECT * FROM alumnos WHERE nota < 5 ORDER BY nota DESC";
        $resultado = $conexion->query($query1);
        echo "<h2>Alumnos suspensos</h2>\n";
        imprimirTabla($resultado);

        /*
        $query1 = "SELECT * FROM alumnos";
        $resultado = $conexion->query($query1);
        while ( $alumno = $resultado->fetch_assoc() ) {
            echo $alumno['nombre']," ",$alumno['ap1']," ",$alumno['ap2'],",",$alumno['nota'];
            echo "<br>";
        }
        */
    ?>
</body>
</html>