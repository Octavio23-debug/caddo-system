<?php
require 'vendor/autoload.php';

$client = stream_socket_client("tcp://192.168.1.9:8081", $errno, $errstr, 1);

if ($client) {
    fwrite($client, "update\n");
    fclose($client);
    echo "Notificación enviada";
} else {
    echo "Error de conexión: $errstr ($errno)";
}
