<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>CSV a tablas</title>
</head>
<body>
    <?php
        function csvToArray($csv, $delimitador) {
            $lineas = explode("\n",$csv);
            foreach ( $lineas as $i => $linea ) {
                $matriz[$i] = explode($delimitador,$linea);
            }

            return $matriz;
        }

        function imprimirTabla($matriz) {
            echo "<table border='1'>";
            foreach ( $matriz as $nlinea => $linea ) {
                echo "<tr>";
                if ( $nlinea == 0 ) {
                    foreach ( $matriz[$nlinea] as $nfield => $field ) {
                        echo "<th>";
                        echo $matriz[$nlinea][$nfield];
                        echo "</th>";
                    }
                } else {
                    foreach ( $matriz[$nlinea] as $nfield => $field ) {
                        echo "<td>";
                        echo $matriz[$nlinea][$nfield];
                        echo "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        
        if ( !$_POST && !$_FILES ) {
    ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#text">Texto</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-toggle="tab" href="#file">Archivo</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-toggle="tab" href="#image">Imagen</a>
        </li>
    </ul>

    <div class="tab-content m-4">
        <div class="tab-pane fade show active" id="text">
            <form action="" method="post">
                <div class="form-group">
                    <textarea name="csv" class="from-control" rows="15" cols="80"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar">
            </form>
        </div>
        <div class="tab-pane fade" id="file">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="from-group">
                    <input type="file" class="form-control-file" name="archivo" id="archivo">
                </div>
                <input type="submit" class="mt-2 btn btn-primary" value="Enviar">
            </form>
        </div>
        <div class="tab-pane fade" id="image">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="from-group">
                    <input type="file" class="form-control-file" name="imagen" id="archivo">
                </div>
                <input type="submit" class="mt-2 btn btn-primary" value="Enviar">
            </form>
        </div>
    </div>
    <?php
        } elseif ( isset($_POST["csv"]) ) {
            $csv = $_POST["csv"];
            
            imprimirTabla(csvToArray($csv, ","));
        } elseif ( isset($_FILES["archivo"]) ) {
            /*if ( !$fp = fopen($_FILES["archivo"]["tmp_name"],"r") ){
                echo "No se ha podido abrir el archivo";
            }

            $csv = fread($fp,filesize($_FILES["archivo"]["tmp_name"]));*/
            $csv = file_get_contents($_FILES["archivo"]["tmp_name"]);
            imprimirTabla(csvToArray($csv, ","));
        } elseif ( isset($_FILES["imagen"]) ) {
            $data = file_get_contents($_FILES["imagen"]["tmp_name"]);
            $type = $_FILES["imagen"]["type"];
            $imagen=base64_encode($data);
            echo "<img src='data:".$type.";base64,".$imagen."'>";
        }
    ?>
</body>
</html>