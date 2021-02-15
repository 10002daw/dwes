<?php

class Producto {
    protected $codigo;
    protected $nombre;
    protected $nombre_corto;
    protected $PVP;
    protected $descripcion;
    protected $familia;
    
    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo,$valor) {
        $this->$atributo=$valor;
    }
    public function __construct($row) {
        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->descripcion=$row['descripcion'];
        $this->PVP = $row['PVP'];
        $this->familia=$row['familia'];
    }
    public static function nuevoProducto($cod,$nombre,$nombre_corto,$descripcion,$PVP,$familia) {
        return new Producto(['cod'=>$cod,'nombre'=>$nombre,'nombre_corto'=>$nombre_corto,'descripcion'=>$descripcion,'PVP'=>$PVP,'familia'=>$familia]);
    }

}

?>
