<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajedrez</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            height: 50px;
            width: 50px;
        }
        img {
            display: block;
            margin: auto;
        }
        .negro {
            background-color: black;
        }
        .verde {
            background-color: green;
        }
    </style>
</head>
<body>
<?php
    $filas = [1=>8,7,6,5,4,3,2,1,];
    $columnas = [1=>"a","b","c","d","e","f","g","h",];
    $col=rand(1,8);
    $fil=rand(1,8);
    if ($_GET) {
        $colL = substr($_GET["pos"], 0, 1);
        $col = array_search($colL, $columnas);
        $fil = substr($_GET["pos"], 1, 1);
    }

    echo "<table>\n";
    echo "<tr>\n";
    echo "<th></th>\n";
    foreach ($columnas as $letra) {
        echo "<th>$letra</th>\n";
    }
    echo "</tr>\n";
    foreach ($filas as $i=>$num) {
        echo "<tr>\n";
        echo "<th>$num</th>\n";
        foreach ($columnas as $j=>$letra) {
            echo "<td ";
            if (abs($fil-$i) == abs($col-$j) && !($fil==$i && $col==$j)) {
                echo "class='verde' ";
                echo 'onclick="',"location.href='ajedrez2.php?pos=$letra$i'",'" ';
            } elseif (($i+$j)%2 == 1) {
                echo "class='negro' ";
            }
            echo "id='$letra$i'>";
            if ($fil==$i && $col==$j) {
                if (($i+$j)%2 == 1) {
                    echo "<image src='images/alfilBlanco.png'>";
                } else {
                    echo "<image src='images/alfilNegro.png'>";
                }
            }
            echo "</td>\n";
        }
    }
    echo "</tr>\n";
    echo "</table>\n";
?>
</body>
</html>