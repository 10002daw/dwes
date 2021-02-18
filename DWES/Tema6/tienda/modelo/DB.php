<?php
require_once('Producto.php');
require_once('Ordenador.php');
class DB {
    public static function mensajeError($mensaje) {
        echo "<p><span style='color: red; font-size: 18pt;'>$mensaje</span></p>";
    }
    protected static function ejecutaConsulta($sql) {
        $dsn = "mysql:host=localhost;dbname=bdtienda;charset=utf8";
        $usuario = 'tienda';
        $contrasena = 'tienda2021';
        
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
    public static function getNumProductos() {
        $sql="SELECT count(*) as numProds FROM producto";
        $resultado=self::ejecutaConsulta($sql);
        if ($resultado) {
            return $resultado->fetch(PDO::FETCH_ASSOC)['numProds'];
        }
        return -1;
    }
    public static function obtieneProductos($ini=0,$numProds=20) {
        $sql = "SELECT * FROM producto LIMIT $ini,$numProds;";
        $resultado = self::ejecutaConsulta ($sql);
        $productos = array();

    	if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            while($row=$resultado->fetch()) {
                $productos[] = new Producto($row);
            }
    	}
        return $productos;
    }

    public static function obtieneOrdenadores($ini=0,$numProds=20) {
        $sql = "SELECT * FROM ordenador o";
        $sql .= " JOIN producto p ON o.cod=p.cod";
        $resultado = self::ejecutaConsulta ($sql);
        $ordenadores = array();

    	if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            while($row=$resultado->fetch()) {
                $ordenadores[] = new Producto($row);
            }
    	}
        return $ordenadores;
    }

    public static function obtieneProducto($codigo) {
        $sql = "SELECT * FROM producto";
        $sql .= " WHERE cod='" . $codigo . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $producto = null;

    	if(isset($resultado)) {
            $row = $resultado->fetch();
            $producto = new Producto($row);
    	}
        
        return $producto;    
    }

    public static function obtieneOrdenador($codigo) {
        $sql = "SELECT * FROM ordenador o";
        $sql .= " JOIN producto p ON o.cod=p.cod";
        $sql .= " WHERE o.cod='" . $codigo . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $producto = null;

    	if(isset($resultado)) {
            $row = $resultado->fetch();
            $ordenador = new Ordenador($row);
    	}
        
        return $ordenador;    
    }
    
    public static function _verificaCliente($nombre, $contrasena) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$nombre' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta ($sql);
        $verificado = false;

        if(isset($resultado)) {
            $fila = $resultado->fetch();
            if($fila !== false) $verificado=true;
        }
        return $verificado;
    }
    //sustituimos la anterior por esta en la que usamos bcrypt en lugar de md5 (ya no se considera seguro)
    public static function verificaCliente($nombre, $pass) {
        $sql="SELECT usuario, contrasena FROM usuarios WHERE USUARIO='$nombre';";
        $resultado=self::ejecutaConsulta($sql);
        if ($resultado) {
            $datosUsuario=$resultado->fetch();
            return password_verify($pass,$datosUsuario['contrasena']);
        }
        return false;
    }
    
}

?>
