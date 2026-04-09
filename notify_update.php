<?php
// notify_update.php

function enviarSenalActualizacion($mensaje = "update") {
    $serverIp = "127.0.0.1"; // Usa la IP real si el WebSocket no está en localhost
    $port = 8090;

    $client = stream_socket_client("tcp://$serverIp:$port", $errno, $errstr, 1);
    if (!$client) {
        error_log("❌ Error al conectar con servidor TCP: $errstr ($errno)");
    } else {
        fwrite($client, $mensaje);
        fclose($client);
    }
}
