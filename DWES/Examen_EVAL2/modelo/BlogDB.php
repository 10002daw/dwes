<?php
require_once('Articulo.php');

class BlogDB {
    public static function mensajeError($mensaje) {
        echo "<p><span style='color: red; font-size: 18pt;'>$mensaje</span></p>";
    }

    protected static function ejecutaConsulta($sql) {
        $dsn = "mysql:host=localhost;dbname=blog;charset=utf8";
        $usuario = 'blog';
        $contrasena = 'blog2021';
        
        try {
            $dwes = new PDO($dsn, $usuario, $contrasena);
            if (substr(strtoupper(trim($sql)),0,6)=="SELECT") {
                $resultado = $dwes->query($sql);
            } else {
                $resultado = $dwes->exec($sql);
            }
        } catch (PDOException $ex) {
            if (!isset($dwes)) {
                self::mensajeError("Error conectando con el servidor de bases de datos.");
                exit(1);
            }
            mensajeError($ex->getMessage());
            exit(2);
        }
        return $resultado;
    }

    public static function getNumArticulos() {
        $sql="SELECT count(*) as numArts FROM articulos";
        $resultado=self::ejecutaConsulta($sql);
        if ($resultado) {
            return $resultado->fetch(PDO::FETCH_ASSOC)['numArts'];
        }
        return -1;
    }

    public static function getArticulos($ini=0,$num=5) {
        $sql = "SELECT * FROM articulos LIMIT $ini,$num;";
        $resultado = self::ejecutaConsulta ($sql);
        $articulos = array();

    	if($resultado) {
            while($row=$resultado->fetch()) {
                $articulos[] = new Articulo($row);
            }
    	}
        return $articulos;
    }

    public static function getArticulo($id) {
        $sql = "SELECT * FROM articulos";
        $sql .= " WHERE id='" . $id . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $articulo = null;

    	if(isset($resultado)) {
            $row = $resultado->fetch();
            $articulo = new Articulo($row);
    	}
        
        return $articulo;    
    }
}