<?php
$data = json_decode(file_get_contents("php://input"), true);

$mensaje = $data['mensaje'] ?? '';
$imagen = $data['imagen'] ?? null;

$token = "8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM";
$chat_id = "-5239631795";

if ($imagen) {
    $img = str_replace('data:image/png;base64,', '', $imagen);
    $img = base64_decode($img);

    file_put_contents("captura.png", $img);

    $url = "https://api.telegram.org/bot$token/sendPhoto";

    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => new CURLFile(realpath("captura.png")),
        'caption' => $mensaje,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_exec($ch);
    curl_close($ch);
}