<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="cadena">
        <br>
        <button type="submit">Enviar</button>
    </form>
    <?php
    if ( isset($_POST["cadena"]) ) {
        $regex = "/[^a-zA-ZñÑá-úÁ-Ú0-9 ]/";
        echo $_POST["cadena"];
        echo "<br>";
        echo preg_replace($regex,"",$_POST["cadena"]);
    }
    ?>
</body>
</html>