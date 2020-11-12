<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $api = "https://api.ipify.org?format=json";
        $ips = [];

        while ( count($ips) < 2 ) {
            $json = file_get_contents($api);
            $json_data = json_decode($json, true);
            if ( !in_array($json_data["ip"],$ips) ) {
                array_push($ips,$json_data["ip"]);
            }
        }
        foreach ( $ips as $ip ) {
            echo $ip;
            echo "<br>";
        }
    ?>
</body>
</html>