var wsUri = "ws://10.10.10.9:9000"; 	
websocket = new WebSocket(wsUri); 
console.log(websocket);

websocket.onmessage = function(ev) {
    var response 		= JSON.parse(ev.data); //PHP sends Json data
    
    var tipo = response.tipo;
    var codigo = response.codigo;
    var descripcion = response.descripcion;
    var pventa = response.pventa;
    var pcompra = response.pcompra;
    var stock = response.stock;
    console.log("mensaje recibido");
    console.log(response);

    document.getElementById(`descripcion-${codigo}`).value = descripcion;
    document.getElementById(`pventa-${codigo}`).value = pventa;
    document.getElementById(`pcompra-${codigo}`).value = pcompra;
    document.getElementById(`stock-${codigo}`).value = stock;
    //document.getElementById(`stock-${codigo}`).style.backgroundColor = "#000080";
    //document.getElementById("pruebas").innerHTML = ev.data;
};

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
            if ( datos.length == 0) {
                enviar = true;
            } else {
                document.getElementById("mensajeError").innerHTML = "El producto ya existe";
            }
        }
    };
    xhttp.open("GET", "getProducto.php?p="+document.getElementById("codigo").value, false);
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
    if (confirm(`¿¿Estás seguro de que deseas guardar el producto con código ${codigo}??`)) {
        descripcion = form["descripcion"].value;
        pcompra = form["pcompra"].value;
        pventa = form["pventa"].value;
        stock = form["stock"].value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                datos=JSON.parse(this.responseText);
                //console.log(datos["producto"]);
                if ( datos.length != 0) {
                    console.log("se ha guardado el producto");
                    habilitarFila(codigo,false,false);
                    habilitar.prodAnterior=undefined;

                    var msg = {
                        tipo: "edicion",
                        codigo: codigo,
                        descripcion: descripcion,
                        pcompra: pcompra,
                        pventa: pventa,
                        stock: stock
                    };
                
                    console.log(msg);
                    console.log(JSON.stringify(msg));
                    //convert and send data to server
                    websocket.send(JSON.stringify(msg));
                } else {
                    console.log("error al guardar el producto");
                }
            }
        };
        xhttp.open("POST", "index.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        cadena = `editar=&codigo=${codigo}&descripcion=${descripcion}&pcompra=${pcompra}&pventa=${pventa}&stock=${stock}`;
        //cadena = cadena.replace(/\s/g, "%20");
        xhttp.send(cadena);
    } 
}

function entradaStock(codigo, stock) {
    let cantidad = prompt(`Unidades del producto ${codigo} que entran:`);
    if ( cantidad == null ) return;

    //prepare json data
    let form=document.getElementById(codigo);
    descripcion = form["descripcion"].value;
    pcompra = form["pcompra"].value;
    pventa = form["pventa"].value;
    stock = parseInt(form["stock"].value)+parseInt(cantidad);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            datos=JSON.parse(this.responseText);
            //console.log(datos["producto"]);
            if ( datos.length != 0) {
                console.log("se ha aumentado el stock");
                habilitarFila(codigo,false,false);
                habilitar.prodAnterior=undefined;

                var msg = {
                    tipo: "entrada",
                    codigo: codigo,
                    descripcion: descripcion,
                    pcompra: pcompra,
                    pventa: pventa,
                    stock: stock
                };
            
                console.log(msg);
                console.log(JSON.stringify(msg));
                //convert and send data to server
                websocket.send(JSON.stringify(msg));
            } else {
                console.log("error al guardar el producto");
            }
        }
    };
    xhttp.open("POST", "index.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    cadena = `editar=&codigo=${codigo}&descripcion=${descripcion}&pcompra=${pcompra}&pventa=${pventa}&stock=${stock}`;
    //cadena = cadena.replace(/\s/g, "%20");
    xhttp.send(cadena);	
}

function salidaStock(codigo, stock) {
    let cantidad = prompt(`Unidades del producto ${codigo} que salen:`);
    if ( cantidad == null ) return;

    if ( cantidad > stock ) {
        alert(`No puedes sacar más de ${stock} unidades`);
        return;
    }

   let form=document.getElementById(codigo);
   descripcion = form["descripcion"].value;
   pcompra = form["pcompra"].value;
   pventa = form["pventa"].value;
   stock = form["stock"].value-parseInt(cantidad);

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
           console.log(this.responseText);
           datos=JSON.parse(this.responseText);
           //console.log(datos["producto"]);
           if ( datos.length != 0) {
               console.log("se ha disminuido el stock");
               habilitarFila(codigo,false,false);
               habilitar.prodAnterior=undefined;

               var msg = {
                   tipo: "salida",
                   codigo: codigo,
                   descripcion: descripcion,
                   pcompra: pcompra,
                   pventa: pventa,
                   stock: stock
               };
           
               console.log(msg);
               console.log(JSON.stringify(msg));
               //convert and send data to server
               websocket.send(JSON.stringify(msg));
           } else {
               console.log("error al guardar el producto");
           }
       }
   };
   xhttp.open("POST", "index.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   cadena = `editar=&codigo=${codigo}&descripcion=${descripcion}&pcompra=${pcompra}&pventa=${pventa}&stock=${stock}`;
   //cadena = cadena.replace(/\s/g, "%20");
   xhttp.send(cadena);	
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