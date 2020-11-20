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
        
        if ( isset($_COOKIE["timeStampUltimaVisita"]) ) {
            $fecha = date("d/m/Y", $_COOKIE["timeStampUltimaVisita"]);
            $hora = date("H:i:s", $_COOKIE["timeStampUltimaVisita"]);

            echo "Tu última visita fue el $fecha a las $hora";
            
            echo "<p>Desde tu última visita, han habido ",$count - $_COOKIE['numVisita']," visitantes";
        } else {
            echo "<p>Esta es tu última visita</p>";
            echo "<p>Eres el visitante número ",$count+1;
        }

        setcookie("timeStampUltimaVisita", getdate()[0], time()+365*24*60*60);
        setcookie("numVisita", ++$count, time()+365*24*60*60);
        
        fwrite($fp,$count);
        fclose($fp);
    ?>
</body>
</html>