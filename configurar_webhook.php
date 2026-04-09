<?php

$token = "bot8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM";

// 🔥 obtener URL de ngrok
// 🔥 obtener URL de ngrok
$ngrok = json_decode(file_get_contents("http://127.0.0.1:4040/api/tunnels"), true);

$url = $ngrok['tunnels'][0]['public_url'];
$webhook = $url . "/caddo/webhook.php";

// 🔗 configurar webhook
file_get_contents("https://api.telegram.org/bot$token/setWebhook?url=$webhook");

echo "Webhook configurado: $webhook";