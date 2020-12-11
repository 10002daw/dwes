<?php 

class Database {
    private static $host="localhost";
    private static $usuario="productos";
    private static $pass="productos2020";
    private static $bd="productos";

    private static $conexion;

    private function __construct() { }

    public static function getConexion() {;
        if ( !isset(self::$conexion) ) {
            @ self::$conexion = new mysqli(self::$host, self::$usuario, self::$pass, self::$bd);
            echo "La conexión no existía y se ha creado<br>";
        } else {
            echo "La conexión ya se había realizado<br>";
        }

        return self::$conexion;
    }
}

$con = Database::getConexion();
$con = Database::getConexion();
$con = Database::getConexion();
$con = Database::getConexion();