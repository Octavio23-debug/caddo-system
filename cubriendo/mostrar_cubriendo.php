<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los registros de la tabla cubriendo
$sql = "SELECT c.id, s.nombre AS sucursal, c.motivo, c.fecha_inicio, c.fecha_fin
        FROM cubriendo c
        JOIN sucursal s ON c.id_s = s.id
        ORDER BY c.fecha_inicio DESC";
$result = $conn->query($sql);

// Crear el array para la respuesta
$response = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $response]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron registros']);
}

$conn->close();
?>
