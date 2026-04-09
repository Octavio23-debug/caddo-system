<?php
session_start();
include '../includes/config.php';
include '../includes/mail.php';

// ==========================
// 🧾 HEADER JSON
// ==========================
header('Content-Type: application/json');

// ==========================
// 🔒 VALIDAR DATOS
// ==========================
if (!isset($_POST['id'], $_POST['pendiente'], $_POST['fecha'], $_POST['usuario_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Faltan datos"
    ]);
    exit;
}

// ==========================
// 📥 DATOS NUEVOS
// ==========================
$id              = intval($_POST['id']);
$nuevoPendiente  = trim($_POST['pendiente']);
$nuevaFecha      = $_POST['fecha'];
$nuevoUsuario    = intval($_POST['usuario_id']);
$quienEdita      = $_SESSION['nombre'] ?? 'Sistema';

// ==========================
// 🔎 OBTENER DATOS ANTERIORES
// ==========================
$sqlOld = $conn->prepare("
    SELECT p.pendiente, p.fecha, u.nombre AS responsable
    FROM pendientes p
    LEFT JOIN usuario u ON p.usuario_id = u.id
    WHERE p.id = ?
");
$sqlOld->bind_param("i", $id);
$sqlOld->execute();
$old = $sqlOld->get_result()->fetch_assoc();

if (!$old) {
    echo json_encode([
        "success" => false,
        "message" => "Pendiente no encontrado"
    ]);
    exit;
}

// Valores anteriores
$pendienteOld    = $old['pendiente'];
$fechaOld        = $old['fecha'];
$responsableOld  = $old['responsable'] ?? 'Sin asignar';

// ==========================
// 🔎 NUEVO RESPONSABLE
// ==========================
$sqlUser = $conn->prepare("SELECT nombre FROM usuario WHERE id = ?");
$sqlUser->bind_param("i", $nuevoUsuario);
$sqlUser->execute();
$user = $sqlUser->get_result()->fetch_assoc();

$responsableNuevo = $user['nombre'] ?? 'Sin asignar';

// ==========================
// ⚡ VALIDAR CAMBIOS
// ==========================
if (
    $pendienteOld == $nuevoPendiente &&
    $fechaOld == $nuevaFecha &&
    $responsableOld == $responsableNuevo
) {
    echo json_encode([
        "success" => true,
        "message" => "No hubo cambios"
    ]);
    exit;
}

// ==========================
// 📝 UPDATE
// ==========================
$sql = "UPDATE pendientes SET pendiente = ?, fecha = ?, usuario_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $nuevoPendiente, $nuevaFecha, $nuevoUsuario, $id);

if ($stmt->execute()) {

    // ==========================
    // 📧 CORREO
    // ==========================
    $destinatarios = obtenerTodosLosCorreos($conn);

    $mensajeCorreo = plantillaPendienteActualizado(
        $responsableOld,
        $pendienteOld,
        $fechaOld,
        $responsableNuevo,
        $nuevoPendiente,
        $nuevaFecha
    );

    // 👇 agregamos quién editó
    $mensajeCorreo = "
        <p><b>$quienEdita</b> actualizó el pendiente:</p>
        " . $mensajeCorreo;

    enviarCorreo("✏️ Pendiente actualizado", $mensajeCorreo, $destinatarios);

    // ==========================
    // 📲 TELEGRAM
    // ==========================
    $mensajeTelegram = "
✏️ <b>PENDIENTE ACTUALIZADO</b>

👤 <b>$quienEdita</b> hizo cambios

📌 <b>ANTES:</b>
👤 Responsable: $responsableOld
📝 Pendiente: $pendienteOld
📅 Fecha: $fechaOld

🆕 <b>AHORA:</b>
👤 Nuevo Responsable: $responsableNuevo
📝 Pendiente: $nuevoPendiente
📅 Nueva Fecha: $nuevaFecha
    ";

    enviarTelegram($mensajeTelegram);

    // ==========================
    // ✅ RESPUESTA
    // ==========================
    echo json_encode([
        "success" => true,
        "message" => "Pendiente actualizado correctamente"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Error al actualizar"
    ]);
}

// ==========================
// 🔒 CIERRE
// ==========================
$stmt->close();
$conn->close();
?>