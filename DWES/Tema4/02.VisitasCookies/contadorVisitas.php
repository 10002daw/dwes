<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de visitas</title>
</head>
<body>
    <?php
        if ( !$fp = fopen("count","r") ){
            echo "No se ha podido abrir el archivo";
        }
        $count = fread($fp, filesize("count"));
        fclose($fp);
        if ( !$fp = fopen("count","w") ){
            echo "No se ha podido abrir el archivo";
        }
        fwrite($fp,++$count);
        fclose($fp);
        echo $count;
    ?>
</body>
</html>