<?php
require_once '../includes/config.php'; 

header('Content-Type: application/json');
$response = ["success" => false, "message" => ""];

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['sucursal'], $data['motivo'])) {
        throw new Exception("Datos incompletos.");
    }

    $sucursal = $conn->real_escape_string($data['sucursal']);
    $motivo = $conn->real_escape_string($data['motivo']);

    $sql = "INSERT INTO monitoreo (sucursal, fecha, motivo) VALUES ('$sucursal', NOW(), '$motivo')";

    if ($conn->query($sql)) {
        $response["success"] = true;
        $response["message"] = "Registro agregado con éxito.";
    } else {
        throw new Exception("Error al agregar monitoreo: " . $conn->error);
    }
} catch (Exception $e) {
    $response["message"] = $e->getMessage();
}

echo json_encode($response);
$conn->close();
?>
