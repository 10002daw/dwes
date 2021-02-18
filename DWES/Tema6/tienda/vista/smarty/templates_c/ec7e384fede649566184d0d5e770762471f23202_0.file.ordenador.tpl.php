<?php
/* Smarty version 3.1.38, created on 2021-02-18 10:31:56
  from '/home/dwes/PHP/DWES/Tema6/tienda/vista/smarty/templates/ordenador.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_602e340c9c03e2_19158397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec7e384fede649566184d0d5e770762471f23202' => 
    array (
      0 => '/home/dwes/PHP/DWES/Tema6/tienda/vista/smarty/templates/ordenador.tpl',
      1 => 1613640714,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_602e340c9c03e2_19158397 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
    <h1>Listado de productos</h1>
  </div>

    <main>
        <h1><?php echo $_smarty_tpl->tpl_vars['ordenador']->value->codigo;?>
</h1>
    </main>
  
  <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
'/>
    </form>        
  </div>
</div>
</body>
</html><?php }
}
