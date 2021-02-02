<?php
// Obtenemos la IP basada en el dominio.
$address = gethostbyname("wss.ohmyroot.com");
 
// Creamos la conexión al socket. 
$client = stream_socket_client("tcp://localhost:9000", $errno, $errorMessage);
 
// Si devuelve false significa que existe un error.
if ($client === false) {
    throw new UnexpectedValueException("Failed to connect: $errorMessage");
}
// Las conexioens de socket son streams de bits al igual que los archivos
// abiertos con fopen, con lo que podemos escribir directamente en el cliente
fwrite($client, "Probando");
// Y usando stream_get_contents podemos leer el contenido.
echo stream_get_contents($client);
 
// Los stream de sockets pueden ser cerrados como si fueran ficheros.
fclose($client);