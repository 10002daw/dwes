<?php
/* Smarty version 3.1.38, created on 2021-02-12 14:43:58
  from '/home/dwes/PHP/DWES/Tema6/tienda/vista/smarty/templates/listaproductos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_6026861e133a14_31660252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f158feabcb9b41503a75503ee0b9b51678ddd97' => 
    array (
      0 => '/home/dwes/PHP/DWES/Tema6/tienda/vista/smarty/templates/listaproductos.tpl',
      1 => 1613136985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6026861e133a14_31660252 (Smarty_Internal_Template $_smarty_tpl) {
?>    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productos']->value, 'producto');
$_smarty_tpl->tpl_vars['producto']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['producto']->value) {
$_smarty_tpl->tpl_vars['producto']->do_else = false;
?>
        <p>
            <form id='<?php echo $_smarty_tpl->tpl_vars['producto']->value->codigo;?>
' action='productos.php' method='post'>
                <input type='hidden' name='cod' value='<?php echo $_smarty_tpl->tpl_vars['producto']->value->codigo;?>
'/>
                <input type='submit' name='enviar' value='Añadir'/>
                <?php if ($_smarty_tpl->tpl_vars['producto']->value->familia == "ORDENA") {?>
                    <a href="ordenador.php?cod=<?php echo $_smarty_tpl->tpl_vars['producto']->value->codigo;?>
"><?php echo $_smarty_tpl->tpl_vars['producto']->value->nombre_corto;?>
</a>    
                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['producto']->value->nombre_corto;?>

                <?php }?>
                : <?php echo $_smarty_tpl->tpl_vars['producto']->value->PVP;?>
 euros.
            </form>
        </p>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
