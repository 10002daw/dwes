<?php
require_once("Producto.php");

class Venta {
    private $listaProductos = [];

    function aniadirProducto($producto, $cantidad) {
        if ( isset($this->listaProductos[$producto->getCodigo()]) ) {
            $this->listaProductos[$producto->getCodigo()]['cantidad'] = $cantidad;
        } else {
            $this->listaProductos[$producto->getCodigo()] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
            ];
        }
    }

    function eliminarProducto($producto) {
        if ( isset($this->listaProductos[$producto->getCodigo()]) ) {
            unset($this->listaProductos[$producto->getCodigo()]);
            return true;
        }
        return false;
    }

    function estaVacio() {
        return count($this->listaProductos) == 0;
    }

    function precioTotal() {
        $total = 0;
        foreach ( $this->listaProductos as $infoProducto ) {
            $total += $infoProducto['producto']->getPventa() * 1.21 * $infoProducto['cantidad'];
        }
        return $total;
    }

    function current() {
        return current($this->listaProductos);
    }

    function currentPrecio() {
        return (current($this->listaProductos)["producto"]->getPventa() * current($this->listaProductos)["cantidad"]);
    }

    function currentPrecioIva() {
        return (current($this->listaProductos)["producto"]->getPventa() * 1.21 * current($this->listaProductos)["cantidad"]);
    }

    function next() {
        return next($this->listaProductos);
    }

    function reset() {
        return reset($this->listaProductos);
    }
}