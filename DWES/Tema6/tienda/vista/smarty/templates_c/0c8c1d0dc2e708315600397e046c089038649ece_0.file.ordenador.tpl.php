<?php
/* Smarty version 3.1.38, created on 2021-02-18 16:53:46
  from '/home/user/DWES/DWES/Tema6/tienda/vista/smarty/templates/ordenador.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_602e8d8ac05771_39036322',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c8c1d0dc2e708315600397e046c089038649ece' => 
    array (
      0 => '/home/user/DWES/DWES/Tema6/tienda/vista/smarty/templates/ordenador.tpl',
      1 => 1613663623,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_602e8d8ac05771_39036322 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejemplo Tema 5: Listado de Productos con Plantillas</title>
    <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/tienda.css" rel="stylesheet" type="text/css">
</head>

<body class="pagproductos">

    <div id="contenedor">
        <div id="encabezado">
            <h1><?php echo $_smarty_tpl->tpl_vars['ordenador']->value->nombre_corto;?>
</h1>
            <p>Código: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->codigo;?>
</p>
        </div>

        <main>
            <h2>Características</h2>
            <ul>
                <li>Procesador: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->procesador;?>
</li>
                <li>RAM: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->ram;?>
</li>
                <li>Tarjeta gráfica: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->grafica;?>
</li>
                <li>Unidad óptica: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->unidadoptica;?>
</li>
                <li>Sistema operativo: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->so;?>
</li>
                <li>Otros: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->otros;?>
</li>
                <li>PVP: <?php echo $_smarty_tpl->tpl_vars['ordenador']->value->PVP;?>
</li>
            </ul>
            <h2>Descripción</h2>
            <p><?php echo $_smarty_tpl->tpl_vars['ordenador']->value->descripcion;?>
</p>
        </main>
        <div id="pie">
            <h3><a href="productos.php">Volver a lista de productos</a></h3>
        </div>
    </div>
</body>

</html><?php }
}
