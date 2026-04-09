<?php
require_once '../includes/config.php'; // Conexión a la base de datos
header('Content-Type: application/json');

// Respuesta por defecto
$response = ["success" => false, "message" => "Datos incompletos."];

// Leer datos JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"]) || empty($data["id"])) {
    echo json_encode($response);
    exit;
}

$id = intval($data["id"]);

// Ejecutar la eliminación
$sql = "DELETE FROM monitoreo WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $response["success"] = true;
    $response["message"] = "Monitoreo eliminado correctamente.";
} else {
    $response["message"] = "Error al eliminar el monitoreo: " . $conn->error;
}

// Enviar respuesta
echo json_encode($response);
$stmt->close();
$conn->close();
?>

