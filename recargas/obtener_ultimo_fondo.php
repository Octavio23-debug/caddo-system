<?php
// Conexión a la base de datos
include('../includes/config.php');

// Consulta para obtener el último fondo
$query = "SELECT fondo FROM recargas ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode(['ultimo_fondo' => $row['fondo']]);
} else {
    echo json_encode(['ultimo_fondo' => 0]); // Fondo inicial si no hay registros
}
