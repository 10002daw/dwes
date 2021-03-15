<?php
/* Smarty version 3.1.38, created on 2021-03-15 11:28:25
  from '/home/user/DWES/DWES/Examen_EVAL2/vista/smarty/templates/detalleArticulo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_604f36c903d8a3_61808905',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83547e49bfd93ed2606795873fb684f137a248ca' => 
    array (
      0 => '/home/user/DWES/DWES/Examen_EVAL2/vista/smarty/templates/detalleArticulo.tpl',
      1 => 1615803833,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604f36c903d8a3_61808905 (Smarty_Internal_Template $_smarty_tpl) {
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
