<?php
/*
{ 'productos' :
    [
        {'id':1, 'descripción': 'Adminte ...', 'nombre': 'nombre del producto', 'precio': 33.25, 'imagen' : 'imagen.jpg'},
        {'id':2, 'descripción': 'Adminte ...', 'nombre': 'nombre del producto', 'precio': 33.25, 'imagen' : 'imagen.jpg'}
    ]
}
*/
require_once("bdProductos.php");
function caracterValido($c) {
    $especiales=[',','.',':',' ','-','ñ','Ñ'];
    if ('a'<$c && $c<'z' || 'A'<$c && $c<'Z' || '0'<$c && $c<'9' || 'á'<$c && $c<'ú' || 'Á'<$c && $c<'Ú' || in_array($c,$especiales)) {
        return true;
    } else {
        return false;
    }
    
}
function validarInput($cadena) {
    //"/[a-z][A-Z][0-9]\-\:\,\. /"
    $cadena=trim($cadena);
    $res="";
    for($i=0;$i<strlen($cadena);$i++) {
        if (caracterValido($cadena[$i])) {
            $res.=$cadena[$i];
        }
    }
    return $res;
}
if ($_GET && isset($_GET['prod'])) {
    $cadena=validarInput($_GET['prod']);
    if (strlen($cadena)==0) {
        echo "{}";
        exit();
    }
    $sql="SELECT * FROM producto WHERE nombre like '%".$cadena."%'";
    $resultado=consulta($sql);
    $listaProductos=[];
    if ($resultado) {
        while($producto=$resultado->fetch(PDO::FETCH_ASSOC)) {
            array_push($listaProductos,$producto);
        }
        //sleep(10);
        echo json_encode(['productos'=>$listaProductos],JSON_UNESCAPED_UNICODE);
    } else {
        mensajeError("No results found...");
    }
}

?>
