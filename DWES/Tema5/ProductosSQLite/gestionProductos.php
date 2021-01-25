<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta charset="utf-8"/>
	<!-- 11 ene. 2021:10:00:51-Usuario: usuario -->
	<style>
	   * { margin:0; padding:0; box-sizing: border-box; }
	   input { width: 100%; height: 4vh; }
	   button { width: 9em; }
	</style>
	<script>
		function habilitarFila(id,habilitar=true) {
			form=document.getElementById(id);
			if (!habilitar) {
				form.reset();
			}
			for(e of form) {
				if (e.name!="id" && e instanceof HTMLInputElement) {
					if (habilitar) {
						e.style.backgroundColor="lightblue";
						form[4].innerHTML='Guardar';
						form[4].onclick=guardar;
					} else {
						e.style.backgroundColor='white';
						form[4].innerHTML='Editar';
						form[4].onclick=habilitar;
					}
					e.readOnly=!habilitar;
				}
			}
		}
		function habilitar(id,boton) {
			if (boton.inerHTML='Editar') {
				if (habilitar.prodAnterior!=undefined) {
					habilitarFila(habilitar.prodAnterior,false);
				}
				habilitar.prodAnterior=id;
				habilitarFila(id,true);
			} else if(boton.innerHTML='Guardar') {
				
			}
		}
		function guardar(id) {
			alert("estás guardando");	
		}
	</script>
</head>
<body>	
<?php
    require_once("bdProductos.php");
    function mostrarProductos($inf=0, $numProds=20) {
        $sql="select * from productos.producto limit $inf,$numProds";   
        $resultado=consulta($sql);
        echo "<table border='1'>\n";
        echo "<thead>\n";
        echo "<tr><th>Id</th><th>Descripción</th><th>Nombre</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>\n";
        echo "</thead>\n";
        echo "<tbody>\n";
        while($producto=$resultado->fetch_assoc()) {
            echo "<tr>\n";
            $id=$producto['id'];
            echo "<form action='' method='post' enctype='multipart/form-data' id='$id'>\n";
            foreach($producto as $campo=>$valor) {
                if ($campo=='id') {
                    echo "<td style='text-align: right;'>$valor</td>";
                } else {
                    echo "<td><input type='text' readonly='readonly' name='$campo' value='$valor'/></td>";
                }
            }
            echo "<td><button type='button' onclick=\"habilitar('$id',this)\">Editar</button></td>";
            echo "<td><button type='button' onclick=''>Borrar</button></td>";
            echo "</form>\n"; 
            echo "</tr>\n";
        }
        echo "</tbody>\n";
        echo "</table>\n";
    }
    mostrarProductos();
?>
</body>
</html>