<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Leer el cuerpo de la solicitud
$inputJSON = file_get_contents('php://input');
$datos = json_decode($inputJSON, true);

// Verificar si los datos están bien formados
if ($datos === null || !isset($datos['id'])) {
    echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos o ID no proporcionado']);
    exit;
}

$id = $datos['id'];

// Log para verificar el ID recibido
file_put_contents('log.txt', "ID recibido: $id\n", FILE_APPEND);

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'b16_38259068_caddo');
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conexion->connect_error]);
    exit;
}

// Obtener el nombre de la sucursal antes de eliminar
$nombreSucursal = '';
$querySucursal = "SELECT s.nombre FROM permisos p JOIN sucursal s ON s.id = p.suc_id WHERE p.id = ?";
$stmtSucursal = $conexion->prepare($querySucursal);
$stmtSucursal->bind_param('i', $id);
$stmtSucursal->execute();
$stmtSucursal->bind_result($nombreSucursal);
$stmtSucursal->fetch();
$stmtSucursal->close();

// Eliminar el permiso
$query = "DELETE FROM permisos WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    file_put_contents('log.txt', "Permiso con ID $id eliminado\n", FILE_APPEND);

    // Notificar por WebSocket
    if ($nombreSucursal) {
        $mensaje = json_encode([
            "sucursal" => $nombreSucursal,
            "estado" => "Permiso eliminado",
            "hora" => date("H:i:s"),
            "mensaje" => "Se eliminó un permiso"
        ]);

        $fp = @stream_socket_client("tcp://127.0.0.1:8090", $errno, $errstr, 1);
        if ($fp) {
            fwrite($fp, $mensaje);
            fclose($fp);
        } else {
            error_log("Error conectando al WebSocket: $errstr ($errno)");
        }
    }

    echo json_encode(['success' => true, 'message' => 'Permiso eliminado correctamente']);
} else {
    file_put_contents('log.txt', "Error al eliminar el permiso con ID $id\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el permiso']);
}

$stmt->close();
$conexion->close();
?>
