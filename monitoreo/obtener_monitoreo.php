<?php
require_once '../includes/config.php'; // Incluir la conexión

header('Content-Type: application/json');

// Inicializar respuesta
$response = ["success" => false, "data" => [], "message" => ""];

try {
    // Consulta para obtener los registros con el nombre de la sucursal
 $sql = "SELECT m.id, m.sucursal, s.nombre, m.fecha, m.motivo 
        FROM monitoreo m
        JOIN sucursal s ON m.sucursal = s.id
        ORDER BY m.fecha DESC";

    
    $resultado = $conn->query($sql);

    if (!$resultado) {
        throw new Exception("Error en la consulta: " . $conn->error);
    }

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $response["data"][] = $fila;
        }
        $response["success"] = true;
    } else {
        $response["message"] = "No se encontraron registros.";
    }

} catch (Exception $e) {
    $response["message"] = $e->getMessage();
}

// Devuelve los datos en formato JSON
echo json_encode($response);

$conn->close();
?>
