<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function mostrarMensaje() {
            console.log("Has pulsado una tecla");
        }
    </script>
</head>
<body>
    <label for="campoBusqueda">Buscar producto:</label>
    <input id="campoBusqueda" onkeyup="mostrarMensaje()">
</body>
</html>