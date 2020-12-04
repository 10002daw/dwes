<?php

class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $foto;
    private $descripcion;
    
    function __construct($id, $nombre, $precio, $foto, $descripcion="") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->foto = $foto;
        $this->descripcion = $descripcion;
    }

    function productoToHTML() {
        $str = "<img src='".$this->foto."'>
        <p>".$this->nombre."</p>
        <p>Precio: ".$this->precio." €</p>";
        
        return $str;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getFoto() {
        return $this->foto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
}