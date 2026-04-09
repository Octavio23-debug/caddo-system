<?php
header('Content-Type: application/json');

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error);
    echo json_encode([]);
    exit;
}

// Obtener el ID de la sucursal desde el parámetro GET
$id_sucursal = intval($_GET['id_sucursal'] ?? 0);
error_log("ID de sucursal recibido: $id_sucursal");

if ($id_sucursal === 0) {
    error_log("ID de sucursal no válido o no recibido.");
    echo json_encode([]);
    exit;
}

// Consulta preparada: obtener cajeras activas en la misma zona de esta sucursal
$sql = "
    SELECT a.id, a.nombre
    FROM agenda a
    INNER JOIN sucursal s ON a.sucursal = s.id
    WHERE s.id_zona = (
        SELECT id_zona FROM sucursal WHERE id = ?
    )
    AND a.estado = 'alta'
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Error preparando la consulta: " . $conn->error);
    echo json_encode([]);
    exit;
}

$stmt->bind_param('i', $id_sucursal);
$stmt->execute();
$result = $stmt->get_result();

$cajeras = [];
while ($row = $result->fetch_assoc()) {
    $cajeras[] = $row;
}

// Imprimir en log cuántas cajeras se obtuvieron
error_log("Cajeras encontradas: " . count($cajeras));

echo json_encode($cajeras);
?>