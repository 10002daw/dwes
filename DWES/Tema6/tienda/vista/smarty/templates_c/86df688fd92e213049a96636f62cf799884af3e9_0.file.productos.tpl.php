<?php
/* Smarty version 3.1.38, created on 2021-02-15 13:17:43
  from '/home/user/DWES/DWES/Tema6/tienda/vista/smarty/templates/productos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_602a6667069bd9_71411823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86df688fd92e213049a96636f62cf799884af3e9' => 
    array (
      0 => '/home/user/DWES/DWES/Tema6/tienda/vista/smarty/templates/productos.tpl',
      1 => 1613391460,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:productoscesta.tpl' => 1,
    'file:listaproductos.tpl' => 1,
  ),
),false)) {
function content_602a6667069bd9_71411823 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: productos.php -->
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
    
  <!-- Dividir en varios templates -->
  <div id="cesta">      
    <?php $_smarty_tpl->_subTemplateRender("file:productoscesta.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  </div>
    
  <div id="productos">
    <?php $_smarty_tpl->_subTemplateRender("file:listaproductos.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  </div>
  
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