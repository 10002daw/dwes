<?php 
require_once("ProductoModel.php");

$productosPorPagina = 5;
$modelo = new ProductoModel($productosPorPagina);
$numProductos = $modelo->getNumProductos();
$numPaginas = intval(ceil($numProductos/$productosPorPagina));
$paginaActual = isset($_GET["p"]) ? $_GET["p"] : 1;
if ( $paginaActual < 1 ) {
    $paginaActual = 1;
} elseif ( $paginaActual > $numPaginas ) {
    $paginaActual = $numPaginas;
}

if ( isset($_POST["crear"]) ) {
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];
    $pcompra = $_POST["pcompra"];
    $pventa = $_POST["pventa"];
    $stock = $_POST["stock"];
    $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
    $modelo->crearProducto($producto);
} elseif ( isset($_POST["borrar"]) ) {
    $codigo = $_POST["codigo"];
    $modelo->borrarProducto($codigo);
} elseif ( isset($_POST["editar"]) ) {
    $codigo = $_POST["codigo"];
    $descripcion = $_POST["descripcion"];
    $pcompra = $_POST["pcompra"];
    $pventa = $_POST["pventa"];
    $stock = $_POST["stock"];
    $producto = new Producto($codigo, $descripcion, $pcompra, $pventa, $stock);
    $modelo->guardarProducto($producto);
} elseif ( isset($_POST["entrada"]) ) {
    $codigo = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $producto = $modelo->getProducto($codigo);
    $producto->aumentarStock($cantidad);
    $modelo->guardarProducto($producto);
} elseif ( isset($_POST["salida"]) ) {
    $codigo = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $producto = $modelo->getProducto($codigo);
    if ( $producto->disminuirStock($cantidad) ) {
        $modelo->guardarProducto($producto);
    } else {
        echo "<h1>No se pueden sacar $cantidad unidades del producto $codigo</h1>";
    }    
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTISIMAL</title>
    <script>
        function calcularMargen(producto) {
            pcompra = document.getElementById(`pcompra-${producto}`).value;
            pventa = document.getElementById(`pventa-${producto}`).value;
            document.getElementById(`margen-${producto}`).value = pventa - pcompra;
        }

        function validar() {
            var xhttp = new XMLHttpRequest();
            enviar = false;
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
				    datos=JSON.parse(this.responseText);
                    //console.log(datos["producto"]);
				    if ( datos["producto"].length == 0) {
                        enviar = true;
                    } else {
                        document.getElementById("mensajeError").innerHTML = "El producto ya existe";
                    }
			    }
			};
			xhttp.open("GET", "producto.php?p="+document.getElementById("codigo").value, false);
			xhttp.send();
            //console.log(enviar);
            return enviar;
        }

        function eliminar(codigo) {
            return confirm(`¿¿Estás de seguro de que deseas borrar el producto con código ${codigo}??`);
        }

        function habilitarFila(codigo,habilitar=true,reset=false) {
			var firstFocus=true;
			var form=document.getElementById(codigo);
			if (reset) {
				form.reset();
			}
			for(e of form.elements) {
				if (e.name!="codigo") {
					if (habilitar) {
						e.className="selected";
						if (firstFocus) {
							e.focus();
							firstFocus=false;
						}
                        if ( e.name == "editar" ) {
						    e.innerHTML = 'Guardar';
                        }
					} else {
                        if ( e.name == "editar" ) {
						    e.innerHTML = 'Editar';
                        }
						e.className="";
					}
					e.readOnly=!habilitar;
				}
			}
		}

        function habilitar(codigo,boton) {
			if (boton.innerHTML=='Editar') {
				if (habilitar.prodAnterior!=undefined) {
					habilitarFila(habilitar.prodAnterior,false,true);
				}
				habilitar.prodAnterior=codigo;
				habilitarFila(codigo,true);
			} else if (boton.innerHTML=='Guardar') {
				guardar(codigo);
				//habilitarFila(id,false,false);
				//delete habilitar.prodAnterior;
			}
		}

        function guardar(codigo) {
			let form=document.getElementById(codigo);
            //console.log(form[6]);
			if (confirm(`¿¿Estás de seguro de que deseas guardar el producto con código ${codigo}??`)) {
				form.submit();
			} 
		}

        function entradaStock(codigo) {
            let cantidad = prompt(`Unidades del producto ${codigo} que entran:`);
            if ( cantidad == null ) return;

            let form = document.createElement("form");
            form.setAttribute("method", "post"); 
            form.setAttribute("action", "");

            let input_codigo = document.createElement("input");
            input_codigo.setAttribute("type", "hidden");
            input_codigo.setAttribute("name", "codigo"); 
            input_codigo.setAttribute("value", codigo);

            let input_cantidad = document.createElement("input");
            input_cantidad.setAttribute("type", "hidden");
            input_cantidad.setAttribute("name", "cantidad"); 
            input_cantidad.setAttribute("value", cantidad);

            let input_opcion = document.createElement("input");
            input_opcion.setAttribute("type", "hidden");
            input_opcion.setAttribute("name", "entrada"); 
            input_opcion.setAttribute("value", "");

            form.append(input_codigo);
            form.append(input_cantidad);
            form.append(input_opcion);
            
            document.body.appendChild(form);

            form.submit();
        }

        function salidaStock(codigo, stock) {
            let cantidad = prompt(`Unidades del producto ${codigo} que salen:`);
            if ( cantidad == null ) return;

            if ( cantidad > stock ) {
                alert(`No puedes sacar más de ${stock} unidades`);
                return;
            }

            let form = document.createElement("form");
            form.setAttribute("method", "post"); 
            form.setAttribute("action", "");

            let input_codigo = document.createElement("input");
            input_codigo.setAttribute("type", "hidden");
            input_codigo.setAttribute("name", "codigo"); 
            input_codigo.setAttribute("value", codigo);

            let input_cantidad = document.createElement("input");
            input_cantidad.setAttribute("type", "hidden");
            input_cantidad.setAttribute("name", "cantidad"); 
            input_cantidad.setAttribute("value", cantidad);

            let input_opcion = document.createElement("input");
            input_opcion.setAttribute("type", "hidden");
            input_opcion.setAttribute("name", "salida"); 
            input_opcion.setAttribute("value", "");

            form.append(input_codigo);
            form.append(input_cantidad);
            form.append(input_opcion);
            
            document.body.appendChild(form);

            form.submit();
        }

        function venta(codigo, stock) {
            let cantidad = prompt(`Unidades del producto ${codigo} que quiere vender:`);
            if ( cantidad == null ) return;

            if ( cantidad > stock ) {
                alert(`No puedes vender más de ${stock} unidades`);
                return;
            }

            let form = document.createElement("form");
            form.setAttribute("method", "post"); 
            form.setAttribute("action", "venta.php");

            let input_codigo = document.createElement("input");
            input_codigo.setAttribute("type", "hidden");
            input_codigo.setAttribute("name", "codigo"); 
            input_codigo.setAttribute("value", codigo);

            let input_cantidad = document.createElement("input");
            input_cantidad.setAttribute("type", "hidden");
            input_cantidad.setAttribute("name", "cantidad"); 
            input_cantidad.setAttribute("value", cantidad);

            let input_opcion = document.createElement("input");
            input_opcion.setAttribute("type", "hidden");
            input_opcion.setAttribute("name", "venta"); 
            input_opcion.setAttribute("value", "");

            form.append(input_codigo);
            form.append(input_cantidad);
            form.append(input_opcion);
            
            document.body.appendChild(form);

            form.submit();
        }
    </script>
</head>
<body>
    <h1>GESTISIMAL</h1>
    <a href="venta.php">Ver venta</a>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Margen</th>
                <th>Stock</th>
                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $productos = $modelo->getProductos($paginaActual);
                foreach ( $productos as $producto ) {
                    $codigo = $producto->getCodigo();
                    $descripcion = $producto->getDescripcion();
                    $pcompra = $producto->getPcompra();
                    $pventa = $producto->getPventa();
                    $margen = $producto->getMargen();
                    $stock = $producto->getStock();
            ?>
            <tr>
                <form action="" method="post" id="<?=$codigo?>">
                    <td>
                        <input type="text" name="codigo" size="5" maxlength="5" value="<?=$codigo?>" readonly required>
                    </td>
                    <td>
                        <input type="text" name="descripcion" size="30" value="<?=$descripcion?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="pcompra" id="pcompra-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" min="0" step="0.01" size="10" value="<?=$pcompra?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="pventa" id="pventa-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" min="0" step="0.01" size="10" value="<?=$pventa?>" readonly required>
                    </td>
                    <td>
                        <input type="number" step="0.01" id="margen-<?=$codigo?>" oninput="calcularMargen('<?=$codigo?>');" size="10" value="<?=$margen?>" readonly required>
                    </td>
                    <td>
                        <input type="number" name="stock" min="0" size="5" value="<?=$stock?>" readonly required>
                    </td>
                    <td>
                        <input type="hidden" name="editar" value="" readonly>
                        <button type="button" name="editar" onclick="habilitar('<?=$codigo?>',this)">Editar</button>
                    </td>
                </form>
                <td>
                    <form action="" method="post" onsubmit="return eliminar('<?=$codigo?>');">
                        <input type="hidden" name="codigo" value="<?=$codigo?>">
                        <button type="submit" name="borrar">Eliminar</button>
                    </form>
                </td>
                <td>
                    <button type="button" onclick="entradaStock('<?=$codigo?>')">Entrada</button>
                </td>
                <td>
                    <button type="button" onclick="venta('<?=$codigo?>', <?=$stock?>)">Venta</button>
                <!--    <button type="button" onclick="salidaStock('<?=$codigo?>', <?=$stock?>)">Salida</button> -->
                </td>
            </tr>
            <?php
                }
            ?>

            <!-- Insertar producto -->
            <tr>
                <form action="" method="post" onsubmit="return validar();">
                    <td><input type="text" name="codigo" id="codigo" size="5" maxlength="5" required></td>
                    <td><input type="text" name="descripcion" size="30" required></td>
                    <td><input type="number" oninput="calcularMargen('nuevo');" name="pcompra" id="pcompra-nuevo" min="0" step="0.01" size="10" required></td>
                    <td><input type="number" oninput="calcularMargen('nuevo');" name="pventa" id="pventa-nuevo" min="0" step="0.01" size="10" required></td>
                    <td><input type="number" id="margen-nuevo" step="0.01" size="10" disabled></td>
                    <td><input type="number" name="stock" min="0" size="5" required></td>
                    <td colspan="2">
                        <button type="submit" name="crear">Nuevo producto</button>
                    </td>
                    <td id="mensajeError" colspan="2"></td>
                </form>
            </tr>

            <!-- Paginación -->
            <tr>
                <td>Página <?=$paginaActual?> de <?=$numPaginas?></td>
                <td></td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="1">
                        <button type="submit">Primera</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$paginaActual-1?>">
                        <button type="submit">Anterior</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$paginaActual+1?>">
                        <button type="submit">Siguiente</button>
                    </form>
                </td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="p" value="<?=$numPaginas?>">
                        <button type="submit">Última</button>
                    </form>
                </td>
                <td colspan="4">
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>