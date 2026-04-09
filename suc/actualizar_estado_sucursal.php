<?php
// Habilitar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
include '../includes/config.php';

// Verifica que se haya recibido el ID de la sucursal
$sucursal_id = $_POST['sucursal_id'] ?? null;
$estado_anterior = $_POST['estado_anterior'] ?? 'Desconocido'; // Estado anterior enviado desde el frontend

if (!$sucursal_id) {
    echo json_encode(["success" => false, "message" => "ID de sucursal inválido"]);
    exit;
}

// Obtener el nombre y el estado actual de la sucursal
$consulta_estado = "SELECT nombre, estado FROM sucursal WHERE id = ?";
$stmt_estado = $conn->prepare($consulta_estado);

if (!$stmt_estado) {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta de estado"]);
    exit;
}

$stmt_estado->bind_param("i", $sucursal_id);
$stmt_estado->execute();
$stmt_estado->bind_result($nombre_sucursal, $estado_actual);
$stmt_estado->fetch();
$stmt_estado->close();

if (!$nombre_sucursal) {
    echo json_encode(["success" => false, "message" => "Sucursal no encontrada"]);
    exit;
}

// Primero, actualiza el estado_anterior con el valor actual
$sqlUpdateEstadoAnterior = "UPDATE sucursal SET estado_anterior = ? WHERE id = ?";
$stmt_update_estado_anterior = $conn->prepare($sqlUpdateEstadoAnterior);

if (!$stmt_update_estado_anterior) {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta para actualizar estado anterior"]);
    exit;
}

$stmt_update_estado_anterior->bind_param("si", $estado_actual, $sucursal_id);
$stmt_update_estado_anterior->execute();
$stmt_update_estado_anterior->close();

// Ahora actualiza el estado a "Normal"
$sqlUpdate = "UPDATE sucursal SET estado = 'Normal', updated_at = NOW() WHERE id = ?";
$stmt = $conn->prepare($sqlUpdate);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta para actualizar estado"]);
    exit;
}

$stmt->bind_param("i", $sucursal_id);

if ($stmt->execute()) {
    // Crear mensaje JSON para enviar al WebSocket
    $mensaje = json_encode([
        "sucursal" => $nombre_sucursal,
        "estado" => "Normal",
        "hora" => date("H:i:s"),
        "mensaje" => "Sucursal restaurada a estado normal"
    ]);

    // Enviar mensaje al WebSocket (puerto interno TCP 8090)
    $fp = @stream_socket_client("tcp://127.0.0.1:8090", $errno, $errstr, 1);
    if ($fp) {
        fwrite($fp, $mensaje);
        fclose($fp);
    } else {
        error_log("Error conectando al WebSocket: $errstr ($errno)");
    }

    echo json_encode([
        "success" => true,
        "message" => "Estado actualizado a 'Normal'.",
        "nombre_sucursal" => $nombre_sucursal,
        "estado_anterior" => $estado_actual
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta para actualizar el estado"]);
}

$stmt->close();
$conn->close();
?>
