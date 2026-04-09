<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/config.php'; // Asegúrate de que este archivo esté en la ubicación correcta

header('Content-Type: application/json');

$sql = "SELECT id, nombre FROM sucursal ORDER BY nombre ASC";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    exit;
}

$sucursales = [];
while ($row = $result->fetch_assoc()) {
    $sucursales[] = $row;
}

// Si hay sucursales, devuelve JSON; si no, devuelve un array vacío
echo json_encode(["success" => true, "data" => $sucursales]);
?>
