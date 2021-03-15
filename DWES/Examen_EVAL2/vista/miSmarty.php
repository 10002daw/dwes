<?php
require_once('Smarty.class.php');
class miSmarty extends Smarty {
    private static $rutaBase="../vista/smarty/";
    public function __construct() {
        parent::__construct();
        $this->template_dir=self::$rutaBase."templates/";
        $this->compile_dir = self::$rutaBase.'templates_c/';
        $this->config_dir = self::$rutaBase.'configs/';
        $this->cache_dir = self::$rutaBase.'cache/';
        $this->assign('css_dir','../vista/css');
    }
}
/*
$smarty->template_dir = '../vista/smarty/templates/';
$smarty->compile_dir = '../web/smarty/tarea/templates_c/';
$smarty->config_dir = '../web/smarty/tarea/configs/';
$smarty->cache_dir = '../web/smarty/tarea/cache/';
*/
?>
