<?php
require_once 'mail.php'; // Aquí tienes tu función enviarCorreo()

// 📬 Correos a los que quieres probar
$destinatarios = [
    'chelito_azul@live.com' 
    
];

// 🧾 Asunto
$asunto = "✅ Prueba de envío de correo - Sistema";

// 💌 Cuerpo bonito en HTML
$mensaje = "
<html>
<head>
    <meta charset='UTF-8'>
</head>
<body style='font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px;'>

    <div style='max-width: 600px; margin: auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
        
        <div style='background-color: #2c3e50; color: #ffffff; padding: 20px; text-align: center;'>
            <h2>📢 Sistema de Monitoreo</h2>
        </div>

        <div style='padding: 20px; color: #333;'>
            <h3>Hola 👋</h3>
            <p>Este es un correo de prueba para verificar que el sistema de envío está funcionando correctamente.</p>

            <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>

            <div style='margin: 20px 0; padding: 15px; background-color: #ecf0f1; border-left: 5px solid #3498db;'>
                ✅ Si estás viendo este correo, significa que todo funciona correctamente.
            </div>

            <p>Ya puedes usar el sistema para enviar notificaciones reales 🚀</p>
        </div>

        <div style='background-color: #f4f6f9; text-align: center; padding: 15px; font-size: 12px; color: #777;'>
            Este es un mensaje automático, por favor no responder.
        </div>

    </div>

</body>
</html>
";

// 🚀 Enviar correo
if (enviarCorreo($asunto, $mensaje, $destinatarios)) {
    echo "✅ Correo enviado correctamente";
} else {
    echo "❌ Error al enviar el correo (revisa logs)";
}
?>