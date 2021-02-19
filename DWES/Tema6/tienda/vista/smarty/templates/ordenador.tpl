<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejemplo Tema 5: Listado de Productos con Plantillas</title>
    <link href="{$css_dir}/tienda.css" rel="stylesheet" type="text/css">
</head>

<body class="pagproductos">

    <div id="contenedor">
        <div id="encabezado">
            <h1>{$ordenador->nombre_corto}</h1>
            <p>Código: {$ordenador->codigo}</p>
        </div>

        <main>
            <h2>Características</h2>
            <ul>
                <li>Procesador: {$ordenador->procesador}</li>
                <li>RAM: {$ordenador->ram}</li>
                <li>Tarjeta gráfica: {$ordenador->grafica}</li>
                <li>Unidad óptica: {$ordenador->unidadoptica}</li>
                <li>Sistema operativo: {$ordenador->so}</li>
                <li>Otros: {$ordenador->otros}</li>
                <li>PVP: {$ordenador->PVP}</li>
            </ul>
            <h2>Descripción</h2>
            <p>{$ordenador->descripcion}</p>
        </main>
        <div id="pie">
            <h3><a href="productos.php">Volver a lista de productos</a></h3>
        </div>
    </div>
</body>

</html>