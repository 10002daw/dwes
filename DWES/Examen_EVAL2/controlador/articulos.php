<?php
require_once('../modelo/BlogDB.php');
require_once('../vista/miSmarty.php');

session_start();

//Número total de artículos que existen
$numArtsTotal = BlogDB::getNumArticulos();

//Número de artículos que mostramos por página
if ( isset($_POST['cambiarArtsPag']) ) {
    if ( $_POST['cambiarArtsPag'] == '-' ) {
        $_SESSION['numArtsPag'] = $_SESSION['numArtsPag']==1? 1 : --$_SESSION['numArtsPag'];
    } elseif ( $_POST['cambiarArtsPag'] == '+' ) {
        $_SESSION['numArtsPag'] = ($_SESSION['numArtsPag']==$numArtsTotal)? $numArtsTotal : ++$_SESSION['numArtsPag'];
    }    
} elseif ( !isset($_SESSION['numArtsPag']) ) {
    $_SESSION['numArtsPag'] = 5;
}
$numArtsPag = $_SESSION['numArtsPag'];

//Número de páginas a mostrar 
$numPag = intval(ceil($numArtsTotal/$numArtsPag));

//Número de la página actual
if ( isset($_GET['pag']) ) {
    if ( $_GET['pag']<1 ) {
        $_SESSION['pag'] = 1;
    } elseif ( $_GET['pag']>$numPag ) {
        $_SESSION['pag'] = $numPag;
    } else {
        $_SESSION['pag'] = $_GET['pag'];
    }
} elseif ( !isset($_SESSION['pag']) ) {
    $_SESSION['pag'] = 1;
}
$pag = $_SESSION['pag'];

$smarty = new miSmarty();

$smarty->assign('numArtsTotal', $numArtsTotal);
$smarty->assign('numArtsPag', $numArtsPag);
$smarty->assign('numPag', $numPag);
$smarty->assign('pagActual', $pag);
$smarty->assign('articulos', BlogDB::getArticulos(($pag-1)*$numArtsPag,$numArtsPag));

$smarty->display('articulos.tpl');