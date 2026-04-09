<?php
// Habilitar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../includes/config.php';

    $sucursal_id = $_POST['sucursal_id'] ?? null;
    $estado = $_POST['estado'] ?? null;

    if ($sucursal_id && $estado) {
        // Actualizar estado
        $query = "UPDATE sucursal SET estado = ? WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $estado, $sucursal_id);

            if ($stmt->execute()) {
                $stmt->close();

                // Obtener el nombre de la sucursal después de actualizar
                $queryNombre = "SELECT nombre FROM sucursal WHERE id = ?";
                $stmtNombre = $conn->prepare($queryNombre);
                $stmtNombre->bind_param("i", $sucursal_id);
                $stmtNombre->execute();
                $stmtNombre->bind_result($nombre_sucursal);
                $stmtNombre->fetch();
                $stmtNombre->close();

                // Crear mensaje JSON para WebSocket
                $mensaje = json_encode([
                    "sucursal" => $nombre_sucursal,
                    "estado" => $estado,
                    "hora" => date("H:i:s"),
                    "mensaje" => "Cambio de estado"
                ]);

                // Enviar mensaje al WebSocket (puerto 8090 en localhost)
                $fp = @stream_socket_client("tcp://127.0.0.1:8090", $errno, $errstr, 1);
                if ($fp) {
                    fwrite($fp, $mensaje);
                    fclose($fp);
                } else {
                    error_log("Error conectando al WebSocket: $errstr ($errno)");
                }

                echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos faltantes.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud no válida.']);
}

exit;
