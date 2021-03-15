<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Artículo</title>
        <link href="{$css_dir}/detalleArticulo.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <h1>{$articulo->titulo}</h1>
        </header>
        
        <main>
            <p>{$articulo->contenido}</p>
        </main>

        <footer>
            <a href="articulos.php">Volver</a>
        </footer>
    </body>
</html>