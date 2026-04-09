<?php

session_start();

require '../includes/config.php';
require '../includes/mail.php';

$data = json_decode(file_get_contents('php://input'), true);

// ===============================
// ✅ VALIDAR DATOS
// ===============================
if (isset($data['id'])) {

    $id = (int) $data['id'];

    if ($id > 0) {

        // ===============================
        // 🔎 OBTENER DATOS DEL PENDIENTE
        // ===============================
        $info = $conn->query("
            SELECT u.nombre AS usuario, p.fecha, s.nombre AS sucursal, p.pendiente
            FROM pendientes p
            LEFT JOIN usuario u ON p.usuario_id = u.id
            LEFT JOIN sucursal s ON p.id_sucursal = s.id
            WHERE p.id = $id
        ");

        if (!$info || $info->num_rows == 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Pendiente no encontrado'
            ]);
            exit;
        }

        $row = $info->fetch_assoc();

        $pendiente = $row['pendiente'];
        $fecha     = $row['fecha'];
        $usuario   = $row['usuario'] ?? 'Usuario';
        $sucursal  = $row['sucursal'] ?? 'Sucursal';

        $quien_finaliza = $_SESSION['nombre'] ?? 'Sistema';

        // ===============================
        // 📝 ACTUALIZAR ESTADO
        // ===============================
        $update = $conn->query("UPDATE pendientes SET estado = 'Listo' WHERE id = $id");

        if ($update) {

            // ===============================
            // 📧 CORREO
            // ===============================
            $correos = obtenerTodosLosCorreos($conn);

            $mensajeCorreo = plantillaPendienteListo(
                $quien_finaliza,
                $sucursal,
                $pendiente,
                $usuario,
                $fecha
            );

            enviarCorreo("✅ Pendiente finalizado", $mensajeCorreo, $correos);

            // ===============================
            // 📲 TELEGRAM
            // ===============================
            $mensajeTelegram = "
<b>✅ Pendiente Finalizado</b>

👤 <b>Finalizado por:</b> $quien_finaliza
🧑‍🔧 <b>Responsable:</b> $usuario
🏢 <b>Sucursal:</b> $sucursal
📅 <b>Fecha:</b> $fecha

📝 <b>Pendiente:</b>
$pendiente
";

            enviarTelegram($mensajeTelegram);

            echo json_encode([
                'success' => true,
                'message' => 'Pendiente marcado como listo'
            ]);

        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar',
                'error' => $conn->error
            ]);
        }

    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID inválido'
        ]);
    }

} else {
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos'
    ]);
}

$conn->close();
?>