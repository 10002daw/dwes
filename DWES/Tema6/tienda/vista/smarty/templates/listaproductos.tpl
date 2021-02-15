    {foreach from=$productos item=producto}
        <p>
            <form id='{$producto->codigo}' action='productos.php' method='post'>
                <input type='hidden' name='cod' value='{$producto->codigo}'/>
                <input type='submit' name='enviar' value='Añadir'/>
                {if $producto->familia=="ORDENA"}
                    <a href="ordenador.php?cod={$producto->codigo}">{$producto->nombre_corto}</a>    
                {else}
                    {$producto->nombre_corto}
                {/if}
                : {$producto->PVP} euros.
            </form>
        </p>
    {/foreach}
