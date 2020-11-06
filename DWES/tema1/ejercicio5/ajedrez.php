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
        table, th, td {
            border: 1px solid black;
        }
        td {
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
    $col=rand(0,7);
    $fil=rand(1,8);
    if ($_GET) {
        $col = substr($_GET["pos"], 0, 1);
        switch ($col) {
            case "a": $col=0; break;
            case "b": $col=1; break;
            case "c": $col=2; break;
            case "d": $col=3; break;
            case "e": $col=4; break;
            case "f": $col=5; break;
            case "g": $col=6; break;
            case "h": $col=7; break;
        }
        $fil = substr($_GET["pos"], 1, 1);
    }

    echo "<table>\n";
    for ($i = 8; $i > 0; $i--) {
        echo "<tr>\n";
        foreach (array("a", "b", "c", "d", "e", "f", "g", "h") as $j => $letra) {
            echo "<td ";
            if (abs($fil-$i) == abs($col-$j) && !($fil==$i && $col==$j)) {
                echo "class='verde' ";
                echo 'onclick="',"location.href='ajedrez.php?pos=$letra$i'",'" ';
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
        echo "</tr>\n";
    }
    echo "</table>\n";
?>
</body>
</html>