<?php
include '../includes/config.php';

header('Content-Type: application/json');

$sql = "
    SELECT id, nombre 
    FROM agenda 
    WHERE cargo LIKE '%Encargad%' 
    AND estado = 'Alta'
    ORDER BY nombre
";

$result = $conn->query($sql);

$encargados = [];

while ($row = $result->fetch_assoc()) {
    $encargados[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $encargados
]);

$conn->close();