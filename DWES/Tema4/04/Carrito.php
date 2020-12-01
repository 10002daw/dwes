<?php

class Carrito {
    private $listaProductos = [];

    function aniadirProducto($producto) {
        if ( isset($this->listaProductos[$producto->getId()]) ) {
            $this->listaProductos[$producto->getId()]['cantidad']++;
        } else {
            $this->listaProductos[$producto->getId()] = [
                'producto' => $producto,
                'cantidad' => 1,
            ];
        }
    }

    function eliminarProducto($producto) {
        if ( isset($this->listaProductos[$producto->getId()]) ) {
            unset($this->listaProductos[$producto->getId()]);
            return true;
        }
        return false;
    }

    function estaVacio() {
        return count($this->listaProductos) == 0;
    }

    function precioTotal() {
        $total = 0;
        foreach ( $listaProductos as $infoProducto ) {
            $total += $infoProducto['producto']->getPrecio() * $infoProducto['cantidad'];
        }
        return $total;
    }
}