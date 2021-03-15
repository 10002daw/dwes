<?php

class Articulo {
    protected $id;
    protected $titulo;
    protected $fecha;
    protected $contenido;
    
    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo,$valor) {
        $this->$atributo=$valor;
    }
    public function __construct($row) {
        $this->id = $row['id'];
        $this->titulo = $row['titulo'];
        $this->fecha = $row['fecha'];
        $this->contenido=$row['contenido'];
    }
}

?>
