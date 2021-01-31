<?php

class Producto {
    private $codigo;
    private $descripcion;
    private $pcompra;
    private $pventa;
    private $margen;
    private $stock;

    function __construct($codigo, $descripcion, $pcompra, $pventa, $stock) {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->pcompra = $pcompra;
        $this->pventa = $pventa;
        $this->margen = $pventa - $pcompra;
        $this->stock = $stock;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPcompra() {
        return $this->pcompra;
    }

    public function setPcompra($pcompra) {
        $this->pcompra = $pcompra;
        $this->margen = $this->venta - $this->pcompra;
    }

    public function getPventa() {
        return $this->pventa;
    }

    public function setPventa($pventa) {
        $this->pventa = $pventa;
        $this->margen = $this->venta - $this->pcompra;
    }

    public function getMargen() {
        return $this->margen;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function aumentarStock($cantidad) {
        $this->stock += $cantidad;
    }

    public function disminuirStock($cantidad) {
        if ( $this->stock >= $cantidad ) {
            $this->stock -= $cantidad;
            return true;
        }
        return false;
    }

    public function getArray() {
        return array(
            "codigo" => $this->codigo,
            "descripcion" => $this->descripcion,
            "pcompra" => $this->pcompra,
            "pventa" => $this->pventa,
            "margen" => $this->margen,
            "stock" => $this->stock
        );
    }

    function toString() {
        $str = "[$this->codigo, $this->descripcion, $this->pcompra, $this->pventa, $this->stock]";
        return $str;
    }

    function toTr() {
        $tr = "<tr>
            <td>$this->codigo</td>
            <td>$this->descripcion</td>
            <td>$this->pcompra</td>
            <td>$this->pventa</td>
            <td>$this->margen</td>
            <td>$this->stock</td>
        </tr>";
        return $tr;
    }
}