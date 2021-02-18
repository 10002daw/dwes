<?php
require_once('../modelo/DB.php');
require_once('../modelo/Ordenador.php');
require_once('../vista/miSmarty.php');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Cargamos la librería de Smarty
$smarty = new miSmarty;
// $smarty->template_dir = '../web/smarty/tarea/templates/';
// $smarty->compile_dir = '../web/smarty/tarea/templates_c/';
// $smarty->config_dir = '../web/smarty/tarea/configs/';
// $smarty->cache_dir = '../web/smarty/tarea/cache/';

if (isset($_GET['cod'])) {
    $smarty->assign('ordenador', DB::obtieneOrdenador($_GET['cod']));
}

$smarty->assign('usuario', $_SESSION['usuario']);

// Mostramos la plantilla
$smarty->display('ordenador.tpl');     
?>