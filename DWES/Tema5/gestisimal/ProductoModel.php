<?php
require_once("Producto.php");

class ProductoModel {
    private $conexion;
    private $limit;

    function __construct() {
        [$host,$usuario,$passwd,$bd]=['localhost','gestisimal','gestisimal2021','gestisimal'];
        $this->conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8",$usuario,$passwd);
        $this->limit = func_num_args() == 1 ? func_get_arg(0) : null;
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
        if ( isset($this->limit) && func_num_args() > 0 ) {
            $inf = (func_get_arg(0)-1) * $this->limit;
            $sql .= " LIMIT $inf, $this->limit";
        }
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

    function getNumProductos() {
        $sql = "SELECT COUNT(*) as num_productos FROM producto";
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC)["num_productos"];
    }

    function crearProducto($producto) {
        $sql = "INSERT INTO producto VALUES (:codigo, :descripcion, :pcompra, :pventa, :stock)";
        $statement = $this->conexion->prepare($sql);
        $statement->bindValue(':codigo', $producto->getCodigo(), PDO::PARAM_STR);
        $statement->bindValue(':descripcion', $producto->getDescripcion(), PDO::PARAM_STR);
        $statement->bindValue(':pcompra', $producto->getPcompra(), PDO::PARAM_STR);
        $statement->bindValue(':pventa', $producto->getPventa(), PDO::PARAM_STR);
        $statement->bindValue(':stock', $producto->getStock(), PDO::PARAM_INT);
        return $statement->execute();
    }

    function guardarProducto($producto) {
        $sql = "UPDATE producto SET descripcion = :descripcion, pcompra = :pcompra, pventa = :pventa, stock = :stock WHERE codigo = :codigo";
        $statement = $this->conexion->prepare($sql);
        $statement->bindValue(':codigo', $producto->getCodigo(), PDO::PARAM_STR);
        $statement->bindValue(':descripcion', $producto->getDescripcion(), PDO::PARAM_STR);
        $statement->bindValue(':pcompra', $producto->getPcompra(), PDO::PARAM_STR);
        $statement->bindValue(':pventa', $producto->getPventa(), PDO::PARAM_STR);
        $statement->bindValue(':stock', $producto->getStock(), PDO::PARAM_INT);
        return $statement->execute();
    }

    function borrarProducto($codigo) {
        $sql = "DELETE FROM producto WHERE codigo = :codigo";
        $statement = $this->conexion->prepare($sql);
        $statement->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        return $statement->execute();
    }

    function existeProducto($codigo) {
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $statement->execute();
        if ( $statement->fetch(PDO::FETCH_ASSOC) ) {
            return true;
        }
        return false;
    }
}