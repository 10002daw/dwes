<?php

class Producto {
    private $codigo;
    private $descripcion;
    private $pcompra;
    private $pventa;
    private $stock;

    function __construct($codigo, $descripcion, $pcompra, $pventa, $stock) {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->pcompra = $pcompra;
        $this->pventa = $pventa;
        $this->stock = $stock;
    }

    function toString() {
        $str = "[$this->codigo, $this->descripcion, $this->pcompra, $this->pventa, $this->stock]";
        return $str;
    }
}