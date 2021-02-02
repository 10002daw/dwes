<?php

$servidor = stream_socket_server("tcp://127.0.0.1:9000", $errno, $errorMessage);
if ($servidor === false) {
    throw new UnexpectedValueException("No se ha podido enlazar el socket: $errorMessage");
}
for (;;) {
    $cliente = @stream_socket_accept($servidor);
    if ($cliente) {
        stream_copy_to_stream($cliente, $cliente);
        fclose($cliente);
    }
}