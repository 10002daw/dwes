<?php
require_once("Producto.php");

class ProductoModel {
    private $conexion;
    /*private $orderBy;
    private $limit;
    private $offset;*/

    function __construct() {
        [$host,$usuario,$passwd,$bd]=['localhost','gestisimal','gestisimal2021','gestisimal'];
        $this->conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
        /*$this->orderBy = "codigo";
        $this->limit = null;
        $this->offset = 0;*/
    }

    function getProducto($codigo) {
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $statement->execute();
        $producto = null;
        if ( $fila = $statement->fetch(PDO::FETCH_ASSOC) ) {
            $descripcion = $fila["descripcion"];
            $pcompra = $fila["pcompra"];
            $pventa = $fila["pventa"];
            $stock = $fila["stock"];
            $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
        }
        return $producto;
    }

    function getProductos($opc="") {
        $sql = "SELECT * FROM producto"." ".$opc;
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
        $productos = [];
        while ( $fila = $statement->fetch(PDO::FETCH_ASSOC) ) {
            $codigo = $fila["codigo"];
            $descripcion = $fila["descripcion"];
            $pcompra = $fila["pcompra"];
            $pventa = $fila["pventa"];
            $stock = $fila["stock"];
            $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
            array_push($productos, $producto);
        }
        return $productos;
    }
}