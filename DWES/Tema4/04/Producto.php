<?php

class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $foto;
    private $descripcion;
    
    function __construct($nombre, $precio, $foto, $descripcion="") {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->foto = $foto;
        $this->descripcion = $descripcion;
    }


}