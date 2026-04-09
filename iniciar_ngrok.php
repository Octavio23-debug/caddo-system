<?php
// 🔥 Verificar si ngrok ya está corriendo
$estado = @file_get_contents("http://127.0.0.1:4040/api/tunnels");

if ($estado === false) {
    // ❌ No está corriendo → iniciarlo
    pclose(popen("start /B ngrok http 80", "r"));
    sleep(5); // esperar a que arranque
}
echo "ngrok listo";