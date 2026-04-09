<?php
$input = file_get_contents("php://input");
$update = json_decode($input, true);

$token = "8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM";

if (isset($update['callback_query'])) {

    $callback = $update['callback_query'];
    $data = $callback['data'];

    $usuario = $callback['from']['first_name'];
    $chat_id = $callback['message']['chat']['id'];
    $message_id = $callback['message']['message_id'];

    // ✅ Quitar loading de Telegram
    file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?" . http_build_query([
        "callback_query_id" => $callback['id'],
        "text" => "Turno recibido ✅"
    ]));

    if ($data === "recibir_turno") {

        $texto = "📦 <b>Entrega de Turno</b>\n\n".
                 "✅ Recibido por: <b>$usuario</b>\n".
                 "🕒 " . date("d/m/Y H:i");

        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
            "chat_id" => $chat_id,
            "text" => $texto,
            "parse_mode" => "HTML"
        ]));

        // 🔥 quitar botón
        file_get_contents("https://api.telegram.org/bot$token/editMessageReplyMarkup?" . http_build_query([
            "chat_id" => $chat_id,
            "message_id" => $message_id,
            "reply_markup" => json_encode(["inline_keyboard" => []])
        ]));
    }
}