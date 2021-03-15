<?php
/* Smarty version 3.1.38, created on 2021-03-15 11:28:12
  from '/home/user/DWES/DWES/Examen_EVAL2/vista/smarty/templates/articulos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_604f36bca0f1f2_95123090',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bab96e44707a33b1cb43851bc3e8f8e2dc160f59' => 
    array (
      0 => '/home/user/DWES/DWES/Examen_EVAL2/vista/smarty/templates/articulos.tpl',
      1 => 1615803833,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604f36bca0f1f2_95123090 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Artículos publicados</title>
        <link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
/blog.css" rel="stylesheet" type="text/css">
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
                        <?php echo $_smarty_tpl->tpl_vars['numArtsPag']->value;?>

                        <button name='cambiarArtsPag' value='+'>+</button>
                    </form>
                </div>
                <div class="pags">
                Páginas:
                <?php
$_smarty_tpl->tpl_vars['p'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['p']->step = 1;$_smarty_tpl->tpl_vars['p']->total = (int) ceil(($_smarty_tpl->tpl_vars['p']->step > 0 ? $_smarty_tpl->tpl_vars['numPag']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['numPag']->value)+1)/abs($_smarty_tpl->tpl_vars['p']->step));
if ($_smarty_tpl->tpl_vars['p']->total > 0) {
for ($_smarty_tpl->tpl_vars['p']->value = 1, $_smarty_tpl->tpl_vars['p']->iteration = 1;$_smarty_tpl->tpl_vars['p']->iteration <= $_smarty_tpl->tpl_vars['p']->total;$_smarty_tpl->tpl_vars['p']->value += $_smarty_tpl->tpl_vars['p']->step, $_smarty_tpl->tpl_vars['p']->iteration++) {
$_smarty_tpl->tpl_vars['p']->first = $_smarty_tpl->tpl_vars['p']->iteration === 1;$_smarty_tpl->tpl_vars['p']->last = $_smarty_tpl->tpl_vars['p']->iteration === $_smarty_tpl->tpl_vars['p']->total;?>
                    <a href='articulos.php?pag=<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a>
                <?php }
}
?>
                </div>
            </nav>
            <section>
                <table>
                    <thead>
                        <tr><th>Fecha</th><th>Título</th></tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articulos']->value, 'articulo');
$_smarty_tpl->tpl_vars['articulo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['articulo']->value) {
$_smarty_tpl->tpl_vars['articulo']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['articulo']->value->fecha;?>
</td>
                                <td><a href='detalleArticulo.php?id=<?php echo $_smarty_tpl->tpl_vars['articulo']->value->id;?>
'><?php echo $_smarty_tpl->tpl_vars['articulo']->value->titulo;?>
</a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <h2>Blog</h2>
        </footer>
    </body>
</html><?php }
}
