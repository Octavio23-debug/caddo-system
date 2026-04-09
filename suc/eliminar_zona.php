<?php
header('Content-Type: application/json');

session_start();

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id_zona'] ?? null;
$tipo = $data['tipo'] ?? '';
$comentario = $data['comentario'] ?? '';

include '../includes/config.php';
include '../includes/mail.php';

$usuario_accion = $_SESSION['nombre'] ?? 'Sistema';

// Validar ID
if (!$id) {
    echo json_encode(["error" => "ID inválido"]);
    exit;
}

// ==========================
// VALIDAR ENCARGADOS
// ==========================
$checkAgenda = $conn->prepare("
    SELECT COUNT(*) as total
    FROM agenda a
    INNER JOIN sucursal s ON a.sucursal = s.id
    WHERE s.id_zona = ?
    AND a.cargo LIKE '%Encargad%'
    AND a.estado = 'Alta'
");
$checkAgenda->bind_param("i", $id);
$checkAgenda->execute();
$resAgenda = $checkAgenda->get_result()->fetch_assoc();

if ($resAgenda['total'] <= 0) {
    echo json_encode(["error" => "No hay encargados activos"]);
    exit;
}


// ==========================
// 🟡 RENUNCIA (CORREGIDO)
// ==========================
if ($tipo == 'renuncia') {

    if (empty($comentario)) {
        echo json_encode(["error" => "Debes agregar un comentario"]);
        exit;
    }

    // 🔎 Obtener SOLO encargada
    $info = $conn->prepare("
        SELECT a.id, a.nombre, s.nombre AS sucursal
        FROM agenda a
        INNER JOIN sucursal s ON a.sucursal = s.id
        WHERE s.id_zona = ?
        AND a.estado = 'Alta'
        AND a.cargo LIKE '%Encargad%'
        LIMIT 1
    ");
    $info->bind_param("i", $id);
    $info->execute();
    $res = $info->get_result()->fetch_assoc();

    if (!$res) {
        echo json_encode(["error" => "No se encontró encargada"]);
        exit;
    }

    $id_empleado = $res['id'];
    $encargado   = $res['nombre'];
    $sucursal    = $res['sucursal'];

    // ✅ UPDATE SOLO A LA ENCARGADA
    $sql = "
        UPDATE agenda
        SET estado = 'Baja', comentario = ?, fecha_fin = NOW()
        WHERE id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $comentario, $id_empleado);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        $destinatarios = obtenerTodosLosCorreos($conn);

        $mensaje = plantillaCorreo(
            'renuncia',
            $usuario_accion,
            $encargado,
            $id,
            $sucursal,
            $comentario
        );

        enviarCorreo("🚨 Renuncia de encargado", $mensaje, $destinatarios);
    }

        $mensajeTelegram = "
            🚨 <b>RENUNCIA</b>

            👤 Encargado: $encargado
            🏪 Sucursal: $sucursal
            📝 Motivo: $comentario
            👨‍💼 Reportó: $usuario_accion
            📅 Fecha: " . date("d/m/Y H:i");

            enviarTelegram($mensajeTelegram);

    echo json_encode(["success" => "Renuncia aplicada correctamente"]);
    exit;
}


// ==========================
// 🔵 CAMBIO DE ROL (CORREGIDO)
// ==========================
if ($tipo == 'cambio') {

    // 🔎 Obtener SOLO encargada
    $info = $conn->prepare("
        SELECT a.id, a.nombre, s.nombre AS sucursal
        FROM agenda a
        INNER JOIN sucursal s ON a.sucursal = s.id
        WHERE s.id_zona = ?
        AND a.estado = 'Alta'
        AND a.cargo LIKE '%Encargad%'
        LIMIT 1
    ");
    $info->bind_param("i", $id);
    $info->execute();
    $res = $info->get_result()->fetch_assoc();

    if (!$res) {
        echo json_encode(["error" => "No se encontró encargada"]);
        exit;
    }

    $id_empleado = $res['id'];
    $encargado   = $res['nombre'];
    $sucursal    = $res['sucursal'];

    // ✅ UPDATE SOLO A LA ENCARGADA
    $sql = "
        UPDATE agenda
        SET cargo = 'Cajera'
        WHERE id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        $destinatarios = obtenerTodosLosCorreos($conn);

        $mensaje = plantillaCorreo(
            'cambio',
            $usuario_accion,
            $encargado,
            $id,
            $sucursal
        );

        enviarCorreo("🔄 Cambio de rol", $mensaje, $destinatarios);
    }

        $mensajeTelegram = "
            🔄 <b>CAMBIO DE ROL</b>

            Encargado: $encargado
            Sucursal: $sucursal
            Zona: $id
            Realizado por: $usuario_accion
            Fecha: " . date("d/m/Y H:i");

            enviarTelegram($mensajeTelegram);

    echo json_encode(["success" => "Cambio aplicado correctamente"]);
    exit;
}

echo json_encode(["error" => "Tipo inválido"]);
$conn->close();
?>