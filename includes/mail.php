    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/../vendor/autoload.php';

    // ===============================
    // 📧 ENVIAR CORREO
    // ===============================
function enviarCorreo($asunto, $mensaje, $destinatarios) {

    // $mail = new PHPMailer(true);

    // try {
    //     $mail->isSMTP();
    //     $mail->Host       = 'smtp.gmail.com';
    //     $mail->SMTPAuth   = true;
    //     $mail->Username   = 'monitoreocaddo@gmail.com';
    //     $mail->Password   = 'kipy pbpl ckmx azvh';
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //     $mail->Port       = 587;

    //     $mail->setFrom('monitoreocaddo@gmail.com', 'Sistema de Notificaciones');
    //     $mail->addReplyTo('monitoreocaddo@gmail.com', 'Monitoreo');

    //     $mail->CharSet = 'UTF-8';
    //     $mail->Encoding = 'base64';

    //     foreach ($destinatarios as $correo) {

    //         $mail->clearAddresses();
    //         $mail->addAddress($correo);

    //         $mail->isHTML(true);
    //         $mail->Subject = $asunto;
    //         $mail->Body    = $mensaje;
    //         $mail->AltBody = strip_tags($mensaje);

    //         // 🔥 CORREGIDO
    //         $mail->MessageID = '<' . uniqid() . '@gmail.com>';
    //         $mail->XMailer   = 'PHP/' . phpversion();

    //         $mail->send();
    //         sleep(1); // 🔥 anti bloqueo
    //     }

        return true;

    // } catch (Exception $e) {
    //     error_log("Error al enviar correo: " . $mail->ErrorInfo);
    //     return false;
    // }
}

    // ===============================
    // 📥 OBTENER CORREOS
    // ===============================
    function obtenerTodosLosCorreos($conn) {
        $correos = [];

        $sql = "SELECT email FROM usuario 
                WHERE email IS NOT NULL 
                AND email != ''";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $correos[] = $row['email'];
        }

        return array_unique($correos);
    }

    // ===============================
    // 🎨 PLANTILLA BONITA
    // ===============================
    function plantillaCorreo($tipo, $usuario, $encargado, $zona, $sucursal, $comentario = '') {

        $fecha = date('d/m/Y H:i');
        $html = "";

        if ($tipo == 'renuncia') {
            $color = '#dc3545';
            $titulo = 'Renuncia de Encargado';
            $descripcion = "$usuario ha registrado la renuncia de <b>$encargado</b> en la zona <b>$zona</b>.";
        } else {
            $color = '#0d6efd';
            $titulo = 'Cambio de Rol';
            $descripcion = "$usuario ha cambiado el rol de <b>$encargado</b> en la zona <b>$zona</b>.";
        }

        $html .= "
        <div style='font-family:Segoe UI, Arial; background:#f4f6f9; padding:20px;'>

            <div style='max-width:650px; margin:auto; background:#fff; border-radius:12px; overflow:hidden;'>

                <div style='background:$color; color:#fff; padding:18px; text-align:center;'>
                    <h2>$titulo</h2>
                </div>

                <div style='padding:25px; color:#333;'>

                    <p>$descripcion</p>

                    <table style='width:100%; border-collapse:collapse;'>
                        <tr><td><b>Encargado:</b></td><td>$encargado</td></tr>
                        <tr><td><b>Sucursal:</b></td><td>$sucursal</td></tr>
                        <tr><td><b>Zona:</b></td><td>$zona</td></tr>
                        <tr><td><b>Fecha:</b></td><td>$fecha</td></tr>
                    </table>
        ";

        if (!empty($comentario)) {
            $html .= "
            <div style='margin-top:15px; padding:10px; background:#f1f1f1; border-left:4px solid $color;'>
                <b>Comentario:</b><br>$comentario
            </div>";
        }

        $html .= "
                </div>

                <div style='background:#f1f1f1; text-align:center; padding:10px; font-size:12px;'>
                    Sistema de Gestión Y Monitoreo by Diego García Perros :) • " . date('Y') . "
                </div>

            </div>
        </div>";

        return $html;
    }
    // 🆕 PLANTILLA PENDIENTE
// ===============================
function plantillaPendiente($creador, $usuario, $sucursal, $pendiente, $fecha) {

    return "
    <div style='font-family:Segoe UI, Arial; background:#f4f6f9; padding:20px;'>

        <div style='max-width:650px; margin:auto; background:#fff; border-radius:12px; overflow:hidden;'>

            <div style='background:#198754; color:#fff; padding:18px; text-align:center;'>
                <h2>Nuevo Pendiente Registrado</h2>
            </div>

            <div style='padding:25px; color:#333;'>

                <p><b>$creador</b> ha registrado un nuevo pendiente.</p>

                <table style='width:100%; border-collapse:collapse;'>
                    <tr><td><b>Sucursal:</b></td><td>$sucursal</td></tr>
                    <tr><td><b>Responsable:</b></td><td>$usuario</td></tr>
                    <tr><td><b>Fecha:</b></td><td>$fecha</td></tr>
                </table>

                 <div style='margin-top:15px; padding:10px; background:#f1f1f1; border-left:4px solid #198754;'>
                     <b>Pendiente:</b><br>$pendiente
                 </div>

             </div>

             <div style='background:#f1f1f1; text-align:center; padding:10px; font-size:12px;'>
                 Sistema de Gestión Y Monitoreo by Diego García Perros :) • " . date('Y') . "
             </div>
         </div>
     </div>";
 }    
        // 🆕 PLANTILLA PENDIENTE LISTO
// ===============================
 function plantillaPendienteListo($quien_finaliza,$usuario, $sucursal, $pendiente, $fecha) {

     return "
     <div style='font-family:Segoe UI, Arial; background:#f4f6f9; padding:20px;'>

         <div style='max-width:650px; margin:auto; background:#fff; border-radius:12px; overflow:hidden;'>

             <div style='background:#198754; color:#fff; padding:18px; text-align:center;'>
                 <h2>Pendiente finalizado</h2>
             </div>

             <div style='padding:25px; color:#333;'>

                 <p><b>$quien_finaliza</b> ha finalizado el pendiente.</p>

                 <table style='width:100%; border-collapse:collapse;'>
                     <tr><td><b>Sucursal:</b></td><td>$sucursal</td></tr>
                     <tr><td><b>Responsable:</b></td><td>$usuario</td></tr>
                     <tr><td><b>Fecha:</b></td><td>$fecha</td></tr>
                 </table>

                 <div style='margin-top:15px; padding:10px; background:#f1f1f1; border-left:4px solid #198754;'>
                     <b>Pendiente:</b><br>$pendiente
                 </div>

             </div>

                 <div style='background:#f1f1f1; text-align:center; padding:10px; font-size:12px;'>
                     Sistema de Gestión Y Monitoreo by Diego García Perros :) • " . date('Y') . "
                 </div>

         </div>
     </div>";
 }

 function plantillaPendienteActualizado(
    $responsableOld,
    $pendienteOld,
    $fechaOld,
    $responsableNuevo,
    $pendienteNuevo,
    $fechaNuevo
) {

    return "
    <div style='font-family:Segoe UI, Arial; background:#f4f6f9; padding:20px;'>

        <div style='max-width:650px; margin:auto; background:#fff; border-radius:12px; overflow:hidden;'>

            <!-- HEADER -->
            <div style='background:#f39c12; color:#fff; padding:18px; text-align:center;'>
                <h2>✏️ Pendiente actualizado</h2>
            </div>

            <!-- BODY -->
            <div style='padding:25px; color:#333;'>

                <p>Se han realizado cambios en el pendiente:</p>

                <!-- ANTES -->
                <div style='margin-top:15px;'>
                    <h3 style='color:#e74c3c;'>📌 Antes</h3>

                    <table style='width:100%; border-collapse:collapse;'>
                        <tr><td><b>Responsable:</b></td><td>$responsableOld</td></tr>
                        <tr><td><b>Fecha:</b></td><td>$fechaOld</td></tr>
                    </table>

                    <div style='margin-top:10px; padding:10px; background:#fdecea; border-left:4px solid #e74c3c;'>
                        <b>Pendiente:</b><br>$pendienteOld
                    </div>
                </div>

                <!-- AHORA -->
                <div style='margin-top:25px;'>
                    <h3 style='color:#27ae60;'>🆕 Ahora</h3>

                    <table style='width:100%; border-collapse:collapse;'>
                        <tr><td><b>Responsable:</b></td><td>$responsableNuevo</td></tr>
                        <tr><td><b>Fecha:</b></td><td>$fechaNuevo</td></tr>
                    </table>

                    <div style='margin-top:10px; padding:10px; background:#eafaf1; border-left:4px solid #27ae60;'>
                        <b>Pendiente:</b><br>$pendienteNuevo
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div style='background:#f1f1f1; text-align:center; padding:10px; font-size:12px;'>
                Sistema de Gestión Y Monitoreo by Diego García Perros :) • " . date('Y') . "
            </div>

        </div>
    </div>";
}

function enviarTelegram($mensaje) {

    $token = "8777509613:AAH91lCOSUn_-_pC8_Rjt1EfoFz-mOBVEjM";
    $chat_id = "-5239631795";

    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $mensaje,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Telegram error: ' . curl_error($ch));
    }

    curl_close($ch);
}

    ?>