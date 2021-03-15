<?php
require_once('../modelo/BlogDB.php');
require_once('../vista/miSmarty.php');

$smarty = new miSmarty();

if ( isset($_GET['id']) ) {
    $smarty->assign('articulo', BlogDB::getArticulo($_GET['id']));
}

$smarty->display('detalleArticulo.tpl');