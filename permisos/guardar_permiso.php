<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Leer el cuerpo de la solicitud
$inputJSON = file_get_contents('php://input');
$datos = json_decode($inputJSON, true);

if ($datos === null) {
    echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos o vacíos']);
    exit;
}

$sucursalId = $datos['sucursal_id'] ?? null;
$permiso = $datos['permiso'] ?? null;

if (!$sucursalId || !$permiso) {
    echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
    exit;
}

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'b16_38259068_caddo');
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conexion->connect_error]);
    exit;
}

// Validar que la sucursal existe y obtener su nombre
$queryValidacion = "SELECT nombre FROM sucursal WHERE id = ?";
$stmtValidacion = $conexion->prepare($queryValidacion);
$stmtValidacion->bind_param('i', $sucursalId);
$stmtValidacion->execute();
$stmtValidacion->bind_result($nombreSucursal);
$stmtValidacion->fetch();

if (!$nombreSucursal) {
    echo json_encode(['success' => false, 'message' => 'La sucursal no existe']);
    $stmtValidacion->close();
    $conexion->close();
    exit;
}

$stmtValidacion->close();

// Insertar el permiso
$query = "INSERT INTO permisos (suc_id, permiso) VALUES (?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param('is', $sucursalId, $permiso);

if ($stmt->execute()) {
    // Éxito: enviar señal por WebSocket
    $mensaje = json_encode([
        "sucursal" => $nombreSucursal,
        "estado" => "Permiso registrado",
        "hora" => date("H:i:s"),
        "mensaje" => "Se otorgó un nuevo permiso"
    ]);

    // Enviar al WebSocket por TCP
    $fp = @stream_socket_client("tcp://127.0.0.1:8090", $errno, $errstr, 1);
    if ($fp) {
        fwrite($fp, $mensaje);
        fclose($fp);
    } else {
        error_log("Error conectando al WebSocket: $errstr ($errno)");
    }

    echo json_encode(['success' => true, 'message' => 'Permiso guardado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar permiso: ' . $stmt->error]);
}

$stmt->close();
$conexion->close();
?>
