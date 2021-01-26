<!DOCTYPE html>
<html lang="es">
<head>
	<title>Gestión de Productos</title>
	<meta charset="utf-8"/>
	<!-- 11 ene. 2021:10:00:51-Usuario: usuario -->
	<style>
	   * { margin:0; padding:0; border:0; box-sizing: border-box; }
	   input, button { width: auto; height: 2em; }
	   button { width: 6em; }
	    
	   table {margin: 0 auto; }
	   tr:nth-child(odd) input { background-color: #ddd; }
	   tr:nth-child(odd) td { background-color: #ddd; }
	   tr:nth-child(odd) button { background-color: #ddd; }
	   .selected { background-color: lightblue !important; }
	   td { padding: 0 1px; border-top: 1px solid black;}
	   a { display: inline-block; margin: 10px; padding: 5px;}
	   input { border: 1px inset; }
	   
	</style>
	<script>
		function habilitarFila(id,habilitar=true,reset=false) {
			var firstFocus=true;
			var form=document.getElementById(id);
			if (reset) {
				form.reset();
			}
			for(e of form.elements) {
				if (e.name!="id" && e instanceof HTMLInputElement) {
					if (habilitar) {
						e.className="selected";
						if (firstFocus) {
							e.focus();
							firstFocus=false;
						}
						form.elements['botonEditarGuardar'].innerHTML='Guardar';
						//form[4].onclick=guardar;
					} else {
						form.elements['botonEditarGuardar'].innerHTML='Editar';
						//form[4].onclick=habilitar;
						e.className="";
					}
					e.readOnly=!habilitar;
				}
			}
		}
		function habilitar(id,boton) {
			if (boton.innerHTML=='Editar') {
				if (habilitar.prodAnterior!=undefined) {
					habilitarFila(habilitar.prodAnterior,false,true);
				}
				habilitar.prodAnterior=id;
				habilitarFila(id,true);
			} else if (boton.innerHTML=='Guardar') {
				guardarBorrar(id,'guardar');
				//habilitarFila(id,false,false);
				//delete habilitar.prodAnterior;
			}
		}
		function guardarBorrar(id,operacion) {
			var form=document.getElementById(id);
			if (confirm("¿¿Estás de seguro de que deseas "+operacion+", "+id+"???")) {
				form.elements['operacion'].value=operacion;
				form.submit();
			} 
		}
		function buscarProducto(input) {
			//alert(input.value);
			var prod=input.value;
			if (prod=="") {
				document.getElementById("resultadosBusquedaProductos").innerHTML = "";
				return;
			}
			var xhttp = new XMLHttpRequest();
			var tablaHtml;
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
				    datos=JSON.parse(this.responseText);
				    tablaHtml="<table>";
				    for(p of datos['productos']) {
				    	tablaHtml+="<tr>";
					    for(campo in p) {
					    	tablaHtml+="<td>"+p[campo]+"</td>";
					    }
					    tablaHtml+="<tr>";
				    }
				    tablaHtml+="</table>";
			        document.getElementById("resultadosBusquedaProductos").innerHTML = tablaHtml ;
			    }
			};
			//location.hostname
			xhttp.open("GET", "consultaProductos.php?prod="+prod, true);
			xhttp.send();
			//alert(tablaHtml);
		}
	</script>
</head>
<body>	
<?php
    require_once("bdProductos.php");
    if ($_POST && isset($_POST['operacion'])) {
        $id=$_POST['id'];$descripcion=$_POST['descripcion']; $nombre=$_POST['nombre']; $precio=$_POST['precio']; $imagen=$_POST['imagen'];
        if ($_POST['operacion']=='guardar') {
            $sql="UPDATE producto SET descripcion='$descripcion',nombre='$nombre',precio=$precio,imagen='$imagen' WHERE id=$id";
            $resultado=consulta($sql);
            if ($resultado) {
                $mensaje="Registro modificado correctamente: $id, $nombre";
                echo "<script>alert('$mensaje');location.href=document.referrer;</script>";
            } else {
                mensajeError("Error actualizando los datos del producto: $id, $nombre");
                exit();
            }
        } else if ($_POST['operacion']=='borrar') {
            $sql="DELETE FROM producto WHERE id=$id";
            $resultado=consulta($sql);
            if ($resultado) {
                $mensaje="Registro borrado correctamente: $id, $nombre";
                echo "<script>alert('$mensaje');window.history.back();</script>";
            } else {
                mensajeError("Error borrando producto: $id, $nombre");
                exit();
            }
        } else if ($_POST['operacion']=='insertar') {
            $sql="INSERT INTO producto VALUES($id,'$descripcion','$nombre',$precio,'$imagen')";
            $resultado=consulta($sql);
            if ($resultado) {
                $mensaje="Producto dado de alta correctamente: $id, $nombre";
                echo "<script>alert('$mensaje');location.href=document.referrer;</script>";
            } else {
                mensajeError("Error dando de alta producto: $id, $nombre");
                exit();
            }
        }
        
    } else {
        function mostrarProductos($inf=0, $numProdsPag=3) {
            //$inputs = getCaracteristicas(establecerConexion("mysql"),"producto");
            $inputs=['id'=>['size'=>6,'align'=>'right'],'descripcion'=>['size'=>40,'align'=>'left'],'nombre'=>['size'=>20,'align'=>'left'],
                     'precio'=>['size'=>8,'align'=>'right'],'imagen'=>['size'=>15,'align'=>'left']];
            $numTotalProds=consulta("select count(*) as numProds from producto")->fetch()['numProds'];
            $numPaginas=intval(ceil($numTotalProds/$numProdsPag));            
            $sql="select * from producto limit $inf,$numProdsPag";
            $resultado=consulta($sql);
            echo "<table border='1'>\n";
            echo "<thead>\n";
            echo "<tr><th>Id</th><th>Descripción</th><th>Nombre</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>\n";
            echo "</thead>\n";
            echo "<tbody>\n";
            while($producto=$resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>\n";
                $id=$producto['id'];
                echo "<form action='' method='post' enctype='multipart/form-data' id='$id'>\n";
                foreach($producto as $campo=>$valor) {
                    $size=$inputs[$campo]['size'];
                    $align=$inputs[$campo]['align'];
                    if ($campo=='id') {
                        echo "<td style='text-align: $align;'>$valor
                                <input type='hidden' name='$campo' value='$valor'/>
                              </td>\n";
                    } else {
                        echo "<td><input style='text-align: $align;' type='text' readonly='readonly' name='$campo' size='$size' value='$valor'/></td>\n";
                    }
                }
                echo "<td><button id='botonEditarGuardar' type='button' onclick=\"habilitar('$id',this)\">Editar</button></td>\n";
                echo "<td><button id='botonBorrar' type='button' onclick=\"guardarBorrar('$id','borrar');\">Borrar</button></td>\n";
                echo "<input type='hidden' id='operacion' name='operacion' value=''/>";
                echo "</form>\n"; 
                echo "</tr>\n";
            }
            echo "</tbody>\n";
            echo "</table>\n";
            
            echo "<form action='' method='post' enctype='multipart/form-data'>";
            echo "<table>";
            foreach($inputs as $nombre=>$input) {
                if ($nombre!='id') {
                    $size=$inputs[$nombre]['size'];
                    $align=$inputs[$nombre]['align'];
                    echo "<tr>";
                    echo "<td><label for='$nombre'>".ucfirst($nombre).":</label></td>";
                    echo "<td><input type='text' size='$size' style='text-align: $align' name='$nombre'/></td>\n";
                    echo "</tr>\n";
                }
            }
            echo "<tr>";
            echo "<input type='hidden' id='operacion' name='operacion' value='insertar'/>";
            echo "<input type='hidden' id='id' name='id' value='null'/>";
            echo "<td><button type='submit'>Nuevo Producto</button></td>\n";
            echo "<td><button type='reset'>Resetear Formulario</button></td>\n";
            echo "</tr>";
            echo "</table>\n";
            for($i=1;$i<=$numPaginas;$i++) {
                echo "<a href='?numPag=$i'>Pág. $i</a>";
            }
            echo "</form>\n";
            echo "<div>";
            echo "<label for='campoBusqueda'>Buscar Producto:</label><input oninput='buscarProducto(this);' type='text' name='campoBusqueda' id='campoBusqueda' size='40'/>";
            echo "<div style='border: 1px solid black;' id='resultadosBusquedaProductos'>";
            echo "</div>";
            echo "</div>";
            
//             echo "<tfoot>
//                     <tr><td colspan='6'>Total Productos en la Base de Datos:</td><td style='text-align: right;'>$numProds</td></tr>
//                   </tfoot>\n";
//             echo "</tbody>\n";
        }
        $numProdsPag=5;
        if ($_GET && isset($_GET['numPag'])) {
            $numPag=$_GET['numPag'];
            mostrarProductos(($numPag-1)*$numProdsPag,$numProdsPag);
        } else {
            mostrarProductos(0,$numProdsPag);
        }
    }
        
?>
</body>
</html>