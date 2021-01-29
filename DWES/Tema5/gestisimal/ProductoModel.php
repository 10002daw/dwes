<?php
require_once("Producto.php");

class ProductoModel {
    private $conexion;

    function __construct() {
        [$host,$usuario,$passwd,$bd]=['localhost','gestisimal','gestisimal2021','gestisimal'];
        $this->conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
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

    function getProductos() {
        $sql = "SELECT * FROM producto";
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
    }
}