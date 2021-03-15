<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Artículos publicados</title>
        <link href="{$css_dir}/blog.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <h1>Artículos publicados</h1>
        </header>
        <main>
            <nav>
                <div class="numPag">
                    <form method='post' action=''>
                        Num. artículos Pag. 
                        <button name='cambiarArtsPag' value='-'>-</button>
                        {$numArtsPag}
                        <button name='cambiarArtsPag' value='+'>+</button>
                    </form>
                </div>
                <div class="pags">
                Páginas:
                {for $p=1 to $numPag}
                    <a href='articulos.php?pag={$p}'>{$p}</a>
                {/for}
                </div>
            </nav>
            <section>
                <table>
                    <thead>
                        <tr><th>Fecha</th><th>Título</th></tr>
                    </thead>
                    <tbody>
                        {foreach from=$articulos item=articulo}
                            <tr>
                                <td>{$articulo->fecha}</td>
                                <td><a href='detalleArticulo.php?id={$articulo->id}'>{$articulo->titulo}</a></td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <h2>Blog</h2>
        </footer>
    </body>
</html>