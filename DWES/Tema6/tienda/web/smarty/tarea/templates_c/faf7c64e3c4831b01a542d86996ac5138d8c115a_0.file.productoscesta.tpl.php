<?php
/* Smarty version 3.1.38, created on 2021-02-07 22:42:14
  from '/home/usuario/PHP/pruebas/tienda/web/smarty/tarea/templates/productoscesta.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_60205eb65606a2_27342612',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faf7c64e3c4831b01a542d86996ac5138d8c115a' => 
    array (
      0 => '/home/usuario/PHP/pruebas/tienda/web/smarty/tarea/templates/productoscesta.tpl',
      1 => 1312200025,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60205eb65606a2_27342612 (Smarty_Internal_Template $_smarty_tpl) {
?>    <h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
    <hr />
    <?php if (empty($_smarty_tpl->tpl_vars['productoscesta']->value)) {?>
        <p>Cesta vacía</p>
    <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productoscesta']->value, 'producto');
$_smarty_tpl->tpl_vars['producto']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['producto']->value) {
$_smarty_tpl->tpl_vars['producto']->do_else = false;
?>
          <p><?php echo $_smarty_tpl->tpl_vars['producto']->value->getcodigo();?>
</p>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>

    <form id='vaciar' action='productos.php' method='post'>
        <?php if (empty($_smarty_tpl->tpl_vars['productoscesta']->value)) {?>
            <input type='submit' name='vaciar' value='Vaciar Cesta' disabled='true' />
        <?php } else { ?>
            <input type='submit' name='vaciar' value='Vaciar Cesta' />
        <?php }?>
    </form>
    <form id='comprar' action='cesta.php' method='post'>
        <?php if (empty($_smarty_tpl->tpl_vars['productoscesta']->value)) {?>
            <input type='submit' name='comprar' value='Comprar' disabled='true' />
        <?php } else { ?>
            <input type='submit' name='comprar' value='Comprar' />
        <?php }?>
    </form> 
<?php }
}
