<?php
/* Smarty version 3.1.38, created on 2021-02-25 11:23:57
  from '/home/dwes/PHP/DWES/Examen_EVAL2/vista/smarty/templates/detalleArticulo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_60377abd9b3f11_95675587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4516766f1338b893022ea1034f7903269f10f87a' => 
    array (
      0 => '/home/dwes/PHP/DWES/Examen_EVAL2/vista/smarty/templates/detalleArticulo.tpl',
      1 => 1614248612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60377abd9b3f11_95675587 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Artículo</title>
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/detalleArticulo.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <h1><?php echo $_smarty_tpl->tpl_vars['articulo']->value->titulo;?>
</h1>
        </header>
        
        <main>
            <p><?php echo $_smarty_tpl->tpl_vars['articulo']->value->contenido;?>
</p>
        </main>

        <footer>
            <a href="articulos.php">Volver</a>
        </footer>
    </body>
</html><?php }
}
