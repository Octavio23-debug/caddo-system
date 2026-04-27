<?php
file_put_contents("log.txt", "ENTRO\n", FILE_APPEND);
$data = json_decode(file_get_contents("php://input"), true);

$mensaje = $data['mensaje'] ?? '';
$imagen = $data['imagen'] ?? null;

$token = "8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM"; 
$chat_id = "-5239631795";

// 🔹 Convertir a texto plano (evita errores de HTML)
$mensajePlano = strip_tags($mensaje);

// 🔹 Función para enviar mensaje en partes (Telegram límite ~4096)
function enviarMensaje($token, $chat_id, $texto) {
    $url = "https://api.telegram.org/bot$token/sendMessage";

    $chunks = str_split($texto, 4000);

    foreach ($chunks as $parte) {
        $post_fields = [
            'chat_id' => $chat_id,
            'text' => $parte
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        // 🔥 DEBUG
        if ($response === false) {
            file_put_contents("log.txt", "CURL ERROR: " . curl_error($ch) . "\n", FILE_APPEND);
        } else {
            file_put_contents("log.txt", "RESPUESTA: " . $response . "\n", FILE_APPEND);
        }

        curl_close($ch);
    }
}
if ($imagen) {

    // 🔹 Procesar imagen base64
    $img = str_replace('data:image/png;base64,', '', $imagen);
    $img = base64_decode($img);

    file_put_contents("captura.png", $img);

    // 🔹 Enviar imagen SIN meter todo el mensaje (evita cortes)
    $url = "https://api.telegram.org/bot$token/sendPhoto";

    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => new CURLFile(realpath("captura.png")),
        'caption' => "📸 Evidencia del turno"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    $response = curl_exec($ch);

file_put_contents("log.txt", "FOTO: " . $response . "\n", FILE_APPEND);

    // 🔥 Enviar TODO el mensaje aparte (completo y sin cortes)
    enviarMensaje($token, $chat_id, $mensajePlano);

} else {
    // 🔹 Solo texto
    enviarMensaje($token, $chat_id, $mensajePlano);
}